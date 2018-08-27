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
              <PersonRalationDegree></PersonRalationDegree>
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
    'requirejs-vue!../templates/components/TextField',
    'requirejs-vue!../templates/components/RadioGroupField',
    'requirejs-vue!../templates/components/SelectboxField',
    'requirejs-vue!../templates/components/CheckboxField'
  ],
  function(
    Vue, 
    store, 
    fnCreateTextField, 
    fnCreateRadioGroupField,
    fnCreateSelectboxField,
    fnCreateCheckboxField
  )
  {
    if (!localStorage.getItem('oState')) {
      location.href = '/?c=NanoProfileApplication';
    } 
    
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
        var FieldOptions;
                
        FieldOptions = {
          sField: 'CarPrice',
          sLabel: 'Цена авто'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'InitialFee',
          sLabel: 'Первоначальный взнос'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'CreditTerm',
          sLabel: 'Срок кредита',
          aItems: {
            "6 мес. (0.5 года)": "6",
            "12 мес. (1 год)": "12",
            "18 мес. (1.5 года)": "18",
            "24 мес. (2 года)": "24",
            "30 мес. (2.5 года)": "30",
            "36 мес. (3 года)": "36",
            "42 мес. (3.5 года)": "42",
            "48 мес. (4 года)": "48",
            "54 мес. (4.5 года)": "54",
            "60 мес. (5 лет)": "60",
            "66 мес. (5.5 лет)": "66",
            "72 мес. (6 лет)": "72",
            "78 мес. (6.5 лет)": "78",
            "84 мес. (7 лет)": "84",
            "90 мес. (7.5 лет)": "90",
            "96 мес. (8 лет)": "96"
          }
        };
        fnCreateSelectboxField(FieldOptions);

        FieldOptions = {
          sField: 'PersonLastName',
          sLabel: 'Фамилия'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonFirstName',
          sLabel: 'Имя'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonFatherName',
          sLabel: 'Отчество'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonGender',
          sLabel: 'Пол',
          aItems: {
            "Муж": "male",
            "Жен": "female"
          }
        };
        fnCreateRadioGroupField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonBirthdate',
          sLabel: 'Дата рождения'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonPassportSeries',
          sLabel: 'Серия'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonPassportNumberDoc',
          sLabel: 'Номер'
        };
        fnCreateTextField(FieldOptions);        

        FieldOptions = {
          sField: 'PersonBirthplace',
          sLabel: 'Место рождения'
        };
        fnCreateTextField(FieldOptions);        

        FieldOptions = {
          sField: 'PersonPhone',
          sLabel: 'Мобильный телефон'
        };
        fnCreateTextField(FieldOptions);    
        
        FieldOptions = {
          sField: 'PersonPassportIssueDate',
          sLabel: 'Дата выдачи'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonPassportIssueCode',
          sLabel: 'Код подразделения'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonPassportIssuePlace',
          sLabel: 'Кем выдан'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonHasDriverLicense',
          sLabel: 'Наличие водительского удостоверения',
          aItems: {
            "Да": "1",
            "Нет": "00"
          }
        };
        fnCreateRadioGroupField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonDriverLicenseType',
          sLabel: 'Тип водительского удостоверения',
          sDefaultValue: "driver_license",
          aItems: {
            "Водительское удостоверение РФ": "driver_license",
            "Водительское удостоверение (Иное)": "driver_license_another"
          }
        };
        fnCreateSelectboxField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonDriveSeries',
          sLabel: 'Серия'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonDriveDocumentNumber',
          sLabel: 'Номер'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonDriveIssueDate',
          sLabel: 'Дата выдачи'
        };
        fnCreateTextField(FieldOptions);
    
        FieldOptions = {
          sField: 'PersonDriveIssuePlace',
          sLabel: 'Кем выдан'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonAnotherDriveSeries',
          sLabel: 'Серия/Номер'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonAnotherDriveIssueDate',
          sLabel: 'Дата выдачи'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonAnotherDriveIssuePlace',
          sLabel: 'Кем выдан'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonRalationDegree',
          sLabel: 'Степень родства',
          aItems: {
            "Супруг": "spouse",
            "Супруга": "wife",
            "Сын/Дочь": "child",
            "Отец/Мать": "parent",
            "Брат/Сестра": "sibling"
          }
        };
        fnCreateSelectboxField(FieldOptions);

        FieldOptions = {
          sField: 'DriverLastName',
          sLabel: 'Фамилия'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverFirstName',
          sLabel: 'Имя'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverFatherName',
          sLabel: 'Отчество'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverGender',
          sLabel: 'Пол',
          aItems: {
            "Муж": "male",
            "Жен": "female"
          }
        };
        fnCreateRadioGroupField(FieldOptions);

        FieldOptions = {
          sField: 'DriverBirthdate',
          sLabel: 'Дата рождения'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverPassportSeries',
          sLabel: 'Серия'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverPassportDocumentNumber',
          sLabel: 'Номер'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverPassportIssuePlace',
          sLabel: 'Кем выдан'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverPassportIssueDate',
          sLabel: 'Дата выдачи'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'DriverPassportIssueCode',
          sLabel: 'Код подразделения'
        };
        fnCreateTextField(FieldOptions);

        FieldOptions = {
          sField: 'PersonRegistrationAddress',
          sLabel: 'Адрес регистрации'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonRegistrationDate',
          sLabel: 'Дата регистрации'
        };
        fnCreateTextField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonHasSameAddress',
          sLabel: 'Совпадает с адресом места жительства'
        };
        fnCreateCheckboxField(FieldOptions);
        
        FieldOptions = {
          sField: 'PersonResidenceAddress',
          sLabel: 'Адрес проживания'
        };
        fnCreateTextField(FieldOptions);
      },
      
      created: function()
      {
        console.log('Application created');
        console.log(this);
      },

      mounted: function()
      {
        console.log('Application mounted');
        this.$store.dispatch('fnLoadFromStorage');  
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
          
          this.fnValidate();
          
          if (!oThis.aErrors.length) {
            return true;
          }
          
          this.$store.dispatch(
            'fnPostShort', 
            {
              fnSuccess: function(oResponseData)
              {
                console.log('fnSendForm - fnPostShort - fnSuccess', oResponseData);
              }
            }
          );
          
          return false;
        },
        
        fnForceUpdate: function()
        {
          console.log('fnForceUpdate');
          this.$forceUpdate();
        },
        
        fnSaveToStorage: function()
        {
          this.$store.dispatch('fnSaveToStorage');
          console.log('fnSaveToStorage - this.aFields', this.aFields);
        }
        
      }      
    });

    return oApplication;
  }
);
</script>
