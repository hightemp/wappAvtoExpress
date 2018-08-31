<template>
  <div :class="sComponentName">
    <div class="" v-bind:class="{ 'form-group':bHorizontal, 'has-error':aErrors.length }">
      <label class="control-label" v-bind:class="{ 'col-sm-2':bHorizontal }">{{sLabel}}</label>
      <div class="" v-bind:class="{ 'col-sm-10':bHorizontal }">
        <template v-for="(sItemValue, sItemKey) in aItems">
          <div class="form-check">
            <input 
              type="radio" 
              class="form-check-input"
              v-bind:class="{ 'is-invalid':aErrors.length }"
              :id="sField+sItemValue"
              :disabled="bDisabled"
              :value="sItemValue"
              v-model="sValue"
            />
            <label class="form-check-label" :for="sField+sItemValue">
              {{sItemKey}}
            </label>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
define(
  [
    'Vue', 
    'jQuery',
    'qtip'
  ], 
  function(Vue) 
  {
    return function(in_oFieldOptions)
    {
      var oDefaultFieldOptions = {
        sField: 'TextField',
        bDisabled: false,
        bHorizontal: false,
        sLabel: 'Text field',
        aItems: {}
      };
      var oFieldOptions = Object.assign(oDefaultFieldOptions, in_oFieldOptions);
      
      if (!oFieldOptions.sComponentName) {
        oFieldOptions.sComponentName = oFieldOptions.sField;
      }

      Vue.component(
        oFieldOptions.sComponentName,
        {
          template: template,
          data: function() 
          {
            return {
              ...oFieldOptions,
              aErrors: [],
            };
          },
          computed: {
            sValue: {
              cache: false,
              get () 
              {
                console.log("get", this.$store.state.oFields[oFieldOptions.sField].sValue);
                return this.$store.state.oFields[oFieldOptions.sField].sValue;
              },
              set (sValue)
              {
                console.log("set", sValue);
                this.fnUpdateField(sValue);
                this.fnValidate();
              }
            }
          },
          methods: {
            fnRefresh: function()
            {
              console.log("fnRefresh");
              this.sValue = this.$store.state.oFields[oFieldOptions.sField].sValue;
            },
            fnValidate: function()
            {
              console.log("fnValidate", this.$store.state.oFields[oFieldOptions.sField]);
              this.aErrors = [];
              var self = this;
              this.$store.dispatch(
                'fnValidateField', 
                {
                  oData: this.$store.state.oFields[oFieldOptions.sField],
                  fnSuccess: function(oResponseData)
                  {
                    console.log('fnSuccess');
                    if (oResponseData.status == 'error') {
                      self.aErrors = oResponseData.errors[oFieldOptions.sField];
                      console.log('aErrors', self.aErrors);                      
                    }
                    
                    $(self.$el)
                      .tooltip('dispose')

                    if (self.aErrors.length) {
                      $(self.$el)
                        .tooltip({
                          placement: 'bottom',
                          html: true,
                          title: `<ul><li>${self.aErrors.join('</li><li>')}</li></ul>`
                        });
                    }                                        
                  } 
                }
              );
            },
            fnUpdateField: function(sValue)
            {
              console.log("fnUpdateField", sValue);
              var oData = Object.assign(this.$data, {sValue: sValue});
              this.$store.dispatch('fnUpdateField', { oData });
              this.$emit('change');
            }
          },
          created: function()
          {
            console.log('Radio field created', oFieldOptions.sField);
            this.fnUpdateField("");
            this.$root.aFields[oFieldOptions.sField] = this;
          }
        }
      );
    }
  }
)
</script>



