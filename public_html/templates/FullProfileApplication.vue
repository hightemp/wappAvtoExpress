<template>
  <form 
    class="form-horizontal profile-form"
    @submit="fnSendForm"
    method="post"
  >
    <div class="button-panel">
      <button type="submit" class="btn btn-success float-right">Сохранить</button>
      <button type="submit" class="btn btn-secondary float-right">Закрыть</button>
    </div>
    
  </form>
</template>

<script>
define(
  [
    'Vue',
    'Store'
  ],
  function(Vue, store, fnCreateTextField)
  {
    var oApplication = new Vue({
      template: template,

      data: {
        aErrors: [],
        aFields: {}
      },
      
      store,

      beforeCreate: function()
      {
        console.log('beforeCreate');
             
      },
      
      created: function()
      {
        console.log('Application created');
        localStorage.removeItem('oState');
      },

      mounted: function()
      {
        console.log('Application mounted');        
      },
      
      methods: {
        fnValidate: function()
        {
          this.aErrors = [];

          for (var iIndex in this.aFields) {
            this.aFields[iIndex].fnValidate();
            this.aErrors = this.aErrors.concat(this.aFields[iIndex].aErrors);
          }
        },
        
        fnSendForm: function(oEvent) 
        {
          oEvent.preventDefault();
          
          var oThis = this;
                    
          this.$store.dispatch(
            'fnPostFull', 
            {
              fnSuccess: function(oResponseData)
              {
                console.log('fnSendForm - fnPostFull - fnSuccess', oResponseData);
                if (oResponseData.status == 'error') {
                  oThis.aErrors = oResponseData.errors;
                } else {
                  
                }
              }
            }
          );
          
          return false;
        }
        
      }      
    });

    return oApplication;
  }
);
</script>
