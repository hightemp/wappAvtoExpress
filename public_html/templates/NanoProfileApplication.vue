<template>
  <form 
    class="form-horizontal profile-form"
    @submit="fnSendForm"
    method="post"
  >
    <div class="button-panel">
      <button type="submit" class="btn btn-success float-right">Отправить</button>
    </div>
    
    <div class="alert alert-danger" v-if="Object.keys(aErrors).length">
      <ul>
        <div v-for="(aFieldErrors, sField) in aErrors">
          <div v-for="sError in aFieldErrors">
            <li><b>{{aFields[sField].sLabel}}</b> - {{sError}}</li>
          </div>
        </div>
      </ul>
    </div>
    
    <div class="container">
      <h3>АНКЕТА КЛИЕНТА</h3>

      <div class="row">
        <div class="col-lg-3">
          <PersonLastName></PersonLastName>
        </div>
        <div class="col-lg-3">
          <PersonFirstName></PersonFirstName>
        </div>
        <div class="col-lg-3">
          <PersonFatherName></PersonFatherName>
        </div>
        <div class="col-lg-2">
          <PersonBirthdate></PersonBirthdate>
        </div>
      </div>

      <h3>ПАСПОРТНЫЕ ДАННЫЕ</h3>

      <div class="row">
        <div class="col-lg-1">
          <PersonPassportSeries></PersonPassportSeries>
        </div>
        <div class="col-lg-1">
          <PersonPassportNumberDoc></PersonPassportNumberDoc>
        </div>
      </div>
    </div>
  </form>
</template>

<style>
</style>

<script>
define(
  [
    'Vue',
    'Store',
    'API',
    'ComponentBuilder'
  ],
  function(
    Vue, 
    oStore, 
    oAPI, 
    oComponentBuilder
  )
  { 
    function fnCreateApplication()
    {
      var oApplication = new Vue({
        template: template,

        data: {
          aErrors: [],
          aFields: {}
        },

        store: oStore,

        beforeCreate: function()
        {
          console.log('Application - beforeCreate');
        },

        created: function()
        {
          console.log('Application - created');
          this.$store.dispatch('Profile/fnClearStorage');
        },

        mounted: function()
        {
          console.log('Application - mounted');        
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
              'Profile/fnPostNano', 
              {
                fnSuccess: function(oResponseData)
                {
                  console.log('Application - fnSendForm - fnPostNano - fnSuccess', oResponseData);
                  if (oResponseData.status == 'error') {
                    oThis.aErrors = oResponseData.errors;
                  } else {
                    oThis.$store.dispatch('Profile/fnSaveToStorage');
                    location.href = '/?c=ShortProfileApplication';
                  }
                }
              }
            );

            return false;
          }

        }      
      });

      oApplication.$mount('#application');
    }

    oAPI.fnGetApplicationFields(
      'Nano',
      function(oData)
      {
        console.log('API - fnGetApplicationFields - Nano - fnSuccess');

        for (var sFieldName in oData.oFields) {
          var FieldOptions;

          FieldOptions = {
            sField: sFieldName
          };
          
          FieldOptions = mergeObjects(FieldOptions, oData.oFields[sFieldName]);

          oComponentBuilder.fnCreate(oData.oFields[sFieldName].sComponentType, FieldOptions);
        }
        
        fnCreateApplication();
      }
    );
  }
);
</script>
