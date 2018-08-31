define(
  [
    'requirejs-vue!../templates/components/TextField',
    'requirejs-vue!../templates/components/RadioGroupField',
    'requirejs-vue!../templates/components/SelectboxField',
    'requirejs-vue!../templates/components/CheckboxField'
  ], 
  function(
    TextField,
    RadioGroupField,
    SelectboxField,
    CheckboxField
  ) 
  {
    return {
      oComponents: {
        TextField: TextField,
        RadioGroupField: RadioGroupField,
        SelectboxField: SelectboxField,
        CheckboxField: CheckboxField
      },
      fnCreate: function(sComponentName, oOptions) {
        return this.oComponents[sComponentName](oOptions);
      }
    }
  }
);

