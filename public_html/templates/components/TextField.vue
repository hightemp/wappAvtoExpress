<template>
  <div :class="sComponentName">
    <div class="" v-bind:class="{ 'form-group':bHorizontal ,'has-error':aErrors.length }">
      <label class="control-label" v-bind:class="{ 'col-sm-2':bHorizontal }">{{sLabel}}</label>
      <div class="" v-bind:class="{ 'col-sm-10':bHorizontal }">
        <input 
          type="text" 
          class="form-control"
          v-bind:class="{ 'is-invalid':aErrors.length }"
          :placeholder="sLabel"
          v-model="sValue"
          :disabled="bDisabled"
        >
      </div>
    </div>
  </div>
</template>

<script>
define(
  [
    'Vue', 
    'jQuery'
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
        sMask: ''
      };
      var oFieldOptions = mergeObjects(oDefaultFieldOptions, in_oFieldOptions);
      
      if (!oFieldOptions.sComponentName) {
        oFieldOptions.sComponentName = oFieldOptions.sField;
      }

      Vue.component(
        oFieldOptions.sComponentName,
        {
          template: template,
          data: function() 
          {
            var oResult = {
              aErrors: []
            };
            
            return mergeObjects(oResult, oFieldOptions);
          },
          computed: {
            sValue: {
              cache: false,
              get () 
              {
                console.log("Text field - get", this.$store.state.Profile.oFields[oFieldOptions.sField].sValue);
                return this.$store.state.Profile.oFields[oFieldOptions.sField].sValue;
              },
              set (sValue)
              {
                console.log("Text field - set", sValue);
                this.fnUpdateField(sValue);
                this.fnValidate();
              }
            }
          },
          methods: {
            fnRefresh: function()
            {
              console.log("Text field - fnRefresh", this.$store.state.Profile.oFields);
              this.sValue = this.$store.state.Profile.oFields[oFieldOptions.sField].sValue;
            },
            fnValidate: function()
            {
              console.log("Text field - fnValidate", this.$store.state.Profile.oFields[oFieldOptions.sField]);
              this.aErrors = [];
              var self = this;
              this.$store.dispatch(
                'Profile/fnValidateField', 
                {
                  oData: this.$store.state.Profile.oFields[oFieldOptions.sField],
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
              console.log("Text field - fnUpdateField", sValue);
              var oData = mergeObjects(this.$data, {sValue: sValue});
              this.$store.dispatch('Profile/fnUpdateField', { oData:oData });
              this.$emit('change');
            }
          },
          created: function()
          {
            console.log('Text field created', oFieldOptions.sField);
            this.fnUpdateField(oFieldOptions.sDefaultValue || "");
            this.$root.aFields[oFieldOptions.sField] = this;
          },
          mounted: function()
          {
            console.log('Text field mounted');
            
            if (oFieldOptions.sMask) {
              $(this.$el).find('input').mask(oFieldOptions.sMask);
            }
          }
        }
      );
    }
  }
)
</script>


