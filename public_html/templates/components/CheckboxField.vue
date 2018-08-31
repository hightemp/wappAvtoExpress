<template>
  <div :class="sComponentName">
    <div class="form-check" v-bind:class="{ 'has-error':aErrors.length }">
      <input 
        type="checkbox" 
        class="form-check-input"
        v-model="sValue"
        :id="sField"
        :disabled="bDisabled"
      >
      <label class="form-check-label" :for="sField">
        {{sLabel}}
      </label>
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
        sField: 'CheckboxField',
        bDisabled: false,
        bHorizontal: false,
        sLabel: 'Checkbox field'
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
                console.log("Checkbox - get", this.$store.state.Profile.oFields[oFieldOptions.sField].sValue);
                return this.$store.state.Profile.oFields[oFieldOptions.sField].sValue;
              },
              set (sValue)
              {
                console.log("Checkbox - set", sValue);
                this.fnUpdateField(sValue);
                this.fnValidate();
              }
            }
          },
          methods: {
            fnRefresh: function()
            {
              console.log("Checkbox - fnRefresh");
              this.sValue = this.$store.state.Profile.oFields[oFieldOptions.sField].sValue;
            },
            fnValidate: function()
            {
              console.log("Checkbox - fnValidate", this.$store.state.Profile.oFields[oFieldOptions.sField]);
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
              console.log("Checkbox - fnUpdateField", sValue);
              var oData = mergeObjects(this.$data, {sValue: sValue});
              this.$store.dispatch('Profile/fnUpdateField', { oData:oData });
              this.$emit('change');
            }
          },
          created: function()
          {
            console.log('Checkbox field created', oFieldOptions.sField);
            this.fnUpdateField(oFieldOptions.sDefaultValue || false);
            this.$root.aFields[oFieldOptions.sField] = this;
          }
        }
      );
    }
  }
)
</script>



