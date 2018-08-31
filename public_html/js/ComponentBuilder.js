define(
  [
    'requirejs-vue!../templates/components/TextField',
    'requirejs-vue!../templates/components/RadioGroupField',
    'requirejs-vue!../templates/components/SelectboxField',
    'requirejs-vue!../templates/components/CheckboxField'
  ], 
  function(
    fnTextField,
    fnRadioGroupField,
    fnSelectboxField,
    fnCheckboxField
  ) 
  {
    return {
      oComponents: {
        TextField: fnTextField,
        RadioGroupField: fnRadioGroupField,
        SelectboxField: fnSelectboxField,
        CheckboxField: fnCheckboxField
      },
      fnCreate: function(sComponentName, oOptions) {
        return this.oComponents[sComponentName](oOptions);
      }
    }
  }
);

