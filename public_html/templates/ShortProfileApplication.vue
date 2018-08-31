<template>
  <form 
    class="form-horizontal profile-form"
    @submit="fnSendForm"
    method="post"
  >
    <div class="button-panel">
      <button type="submit" class="btn btn-success float-right">Отправить</button>
      <button class="btn btn-secondary float-right" @click="fnSaveToStorage">Сохранить</button>
      <!--button class="btn btn-secondary float-right" @click="fnRefresh">Обновить</button-->
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
      <h3>КАЛЬКУЛЯТОР</h3>
      
      <div class="row">
        <div class="col-lg-3">
          <CarPrice></CarPrice>
        </div>
        <div class="col-lg-3">
          <InitialFee></InitialFee>
        </div>
        <div class="col-lg-2">
          <CreditTerm></CreditTerm>
        </div>
      </div>

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
        <div class="col-lg-1">
          <PersonGender></PersonGender>
        </div>
        <div class="col-lg-2">
          <PersonBirthdate></PersonBirthdate>
        </div>
        
        <div class="col-lg-9">
          <PersonBirthplace></PersonBirthplace>
        </div>
        <div class="col-lg-3">
          <PersonPhone></PersonPhone>
        </div>
      </div>
      
      <h3>Паспортные данные</h3>

      <div class="row">
        <div class="col-lg-1">
          <PersonPassportSeries></PersonPassportSeries>
        </div>
        <div class="col-lg-1">
          <PersonPassportNumberDoc></PersonPassportNumberDoc>
        </div>
        <div class="col-lg-2">
          <PersonPassportIssueDate></PersonPassportIssueDate>
        </div>
        <div class="col-lg-2">
          <PersonPassportIssueCode></PersonPassportIssueCode>
        </div>
        <div class="col-lg-6">
          <PersonPassportIssuePlace></PersonPassportIssuePlace>
        </div>        
      </div>
      
      <h3>АДРЕС ЗАЕМЩИКА</h3>
      
      <div class="row">
        <div class="col-lg-10">
          <PersonRegistrationAddress></PersonRegistrationAddress>
        </div>
        <div class="col-lg-2">
          <PersonRegistrationDate></PersonRegistrationDate>
        </div>
        <div class="col-lg-12" style="padding-top:10px">
          <PersonHasSameAddress ref="PersonHasSameAddress" @change="fnForceUpdate"></PersonHasSameAddress>
        </div>        
        <div class="col-lg-12" v-bind:class="{'hidden':$refs.PersonHasSameAddress && $refs.PersonHasSameAddress.sValue != ''}">
          <PersonResidenceAddress></PersonResidenceAddress>
        </div>
      </div>
      
      <h3 v-if="$refs.PersonHasDriverLicense && ($refs.PersonHasDriverLicense.sValue == '1' || !$refs.PersonHasDriverLicense.sValue)">
        ВОДИТЕЛЬСКОЕ УДОСТОВЕРЕНИЕ
      </h3>
      <h3 v-if="$refs.PersonHasDriverLicense && $refs.PersonHasDriverLicense.sValue == '00'">
        ВОДИТЕЛЬСКОЕ УДОСТОВЕРЕНИЕ ЛИЦА ДОПУЩЕННОГО К УПРАВЛЕНИЮ
      </h3>
      
      <div class="row">
        <div class="col-lg-4">
          <PersonHasDriverLicense ref="PersonHasDriverLicense" @change="fnForceUpdate"></PersonHasDriverLicense>
        </div>
        <div class="col-lg-8">
          <PersonDriverLicenseType ref="PersonDriverLicenseType" @change="fnForceUpdate"></PersonDriverLicenseType>
          
          <hr/>
          
          <div class="row" v-bind:class="{'hidden':$refs.PersonDriverLicenseType && $refs.PersonDriverLicenseType.sValue != 'driver_license_another'}">
            <div class="col-lg-3">
              <PersonAnotherDriveSeries></PersonAnotherDriveSeries>
            </div>
            <div class="col-lg-2">
              <PersonAnotherDriveIssueDate></PersonAnotherDriveIssueDate>
            </div>
            <div class="col-lg-5">
              <PersonAnotherDriveIssuePlace></PersonAnotherDriveIssuePlace>
            </div>
          </div>

          <div class="row" v-bind:class="{'hidden':$refs.PersonDriverLicenseType && $refs.PersonDriverLicenseType.sValue != 'driver_license'}">
            <div class="col-lg-2">
              <PersonDriveSeries></PersonDriveSeries>
            </div>
            <div class="col-lg-2">
              <PersonDriveDocumentNumber></PersonDriveDocumentNumber>
            </div>
            <div class="col-lg-2">
              <PersonDriveIssueDate></PersonDriveIssueDate>
            </div>
            <div class="col-lg-5">
              <PersonDriveIssuePlace></PersonDriveIssuePlace>
            </div>
          </div>
          
        </div>
      </div>
      
      <div v-bind:class="{'hidden':$refs.PersonHasDriverLicense && $refs.PersonHasDriverLicense.sValue != '00'}">
        <h3>ЛИЦО ДОПУЩЕННОЕ К УПРАВЛЕНИЮ</h3>
        
        <div class="row">
            <div class="col-lg-2">
              <PersonRelationDegree></PersonRelationDegree>
            </div>
            <div class="col-lg-2">
              <DriverLastName></DriverLastName>
            </div>
            <div class="col-lg-2">
              <DriverFirstName></DriverFirstName>
            </div>
            <div class="col-lg-2">
              <DriverFatherName></DriverFatherName>
            </div>
            <div class="col-lg-1">
              <DriverGender></DriverGender>
            </div>
            <div class="col-lg-2">
              <DriverBirthdate></DriverBirthdate>
            </div>
        </div>
        
        <h3>ПАСПОРТНЫЕ ДАННЫЕ ЛИЦА ДОПУЩЕННОГО К УПРАВЛЕНИЮ</h3>

        <div class="row">
            <div class="col-lg-1">
              <DriverPassportSeries></DriverPassportSeries>
            </div>
            <div class="col-lg-1">
              <DriverPassportDocumentNumber></DriverPassportDocumentNumber>
            </div>
            <div class="col-lg-2">
              <DriverPassportIssueDate></DriverPassportIssueDate>
            </div>
            <div class="col-lg-2">
              <DriverPassportIssuePlace></DriverPassportIssuePlace>
            </div>
            <div class="col-lg-6">
              <DriverPassportIssueCode></DriverPassportIssueCode>
            </div>
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
    if (!localStorage.getItem('oState')) {
      location.href = '/?c=NanoProfileApplication';
    } 
    
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
          console.log('Application - created', this);
        },

        mounted: function()
        {
          console.log('Application - mounted');
          this.$store.dispatch('Profile/fnLoadFromStorage');  
          this.fnRefresh();
        },

        methods: {
          fnRefresh: function()
          {
            var oThis = this;

            for (var iIndex in oThis.aFields) {
              oThis.aFields[iIndex].fnRefresh();
            }
          },

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
              'Profile/fnPostShort', 
              {
                fnSuccess: function(oResponseData)
                {
                  console.log('Application - fnSendForm - fnPostShort - fnSuccess', oResponseData);
                  if (oResponseData.status == 'error') {
                    oThis.aErrors = oResponseData.errors;
                  } else {
                    //location.href = '/?c=ProfilesList';
                  }
                }
              }
            );

            return false;
          },

          fnForceUpdate: function()
          {
            console.log('Application - fnForceUpdate');
            this.$forceUpdate();
          },

          fnSaveToStorage: function()
          {
            this.$store.dispatch('Profile/fnSaveToStorage');
            console.log('Application - fnSaveToStorage - this.aFields', this.aFields);
          }

        }      
      });

      oApplication.$mount('#application');
    }
    
    oAPI.fnGetApplicationFields(
      'Short',
      function(oData)
      {
        console.log('API - fnGetApplicationFields - Short - fnSuccess');

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
