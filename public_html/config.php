<?php

if (!function_exists('config')) {
  function config($sKey, $sDefaultValue='')
  {
    $aConfig = include "config.php";

    return isset($aConfig[$sKey]) ? $aConfig[$sKey] : $sDefaultValue;
  }
}

return [
  'aAvailableFieldsClientData' => [
    "sComponentType",
    "sLabel",
    "sMask",
    "aItems",
  ],
  'aApplicationsFields' => [
    'Nano' => [
      "PersonLastName",
      "PersonFirstName",
      "PersonFatherName",
      "PersonBirthdate",
      "PersonPassportSeries",
      "PersonPassportNumberDoc",
    ],
    'Short' => [
      "CarPrice",          
      "InitialFee",          
      "CreditTerm",          
      "PersonLastName",          
      "PersonFirstName",          
      "PersonFatherName",          
      "PersonGender",          
      "PersonBirthdate",          
      "PersonPassportSeries",          
      "PersonPassportNumberDoc",          
      "PersonBirthplace",          
      "PersonPhone",          
      "PersonPassportIssueDate",          
      "PersonPassportIssueCode",          
      "PersonPassportIssuePlace",          
      "PersonHasDriverLicense",          
      "PersonDriverLicenseType",          
      "PersonDriveSeries",          
      "PersonDriveDocumentNumber",          
      "PersonDriveIssueDate",          
      "PersonDriveIssuePlace",          
      "PersonAnotherDriveSeries",          
      "PersonAnotherDriveIssueDate",          
      "PersonAnotherDriveIssuePlace",          
      "PersonRelationDegree",          
      "DriverLastName",          
      "DriverFirstName",          
      "DriverFatherName",          
      "DriverGender",          
      "DriverBirthdate",          
      "DriverPassportSeries",          
      "DriverPassportDocumentNumber",          
      "DriverPassportIssuePlace",          
      "DriverPassportIssueDate",          
      "DriverPassportIssueCode",          
      "PersonRegistrationAddress",          
      "PersonRegistrationDate",          
      "PersonHasSameAddress",
      "PersonResidenceAddress",
    ],
    'Full' => [
      "",          
    ],
  ],
  'aFields' => [
    "CarPrice" => [
      "sTableField" => "car_price",
      "sTable" => "application",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Цена авто",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
        "range" => [
          "min" => 100000
        ],
      ],
    ],
    "InitialFee" => [
      "sTableField" => "credit_initial",
      "sTable" => "application",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Первоначальный взнос",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number",
        ],
        "initial_fee" => true,
      ],
    ],
    "CreditTerm" => [
      "sTableField" => "credit_term",
      "sTable" => "application",
      "sTableType" => "INT",
      "sComponentType" => "SelectboxField",
      "sLabel" => "Срок кредита",
      "aItems" => [
        "6 мес. (0.5 года)" => "6",
        "12 мес. (1 год)" => "12",
        "18 мес. (1.5 года)" => "18",
        "24 мес. (2 года)" => "24",
        "30 мес. (2.5 года)" => "30",
        "36 мес. (3 года)" => "36",
        "42 мес. (3.5 года)" => "42",
        "48 мес. (4 года)" => "48",
        "54 мес. (4.5 года)" => "54",
        "60 мес. (5 лет)" => "60",
        "66 мес. (5.5 лет)" => "66",
        "72 мес. (6 лет)" => "72",
        "78 мес. (6.5 лет)" => "78",
        "84 мес. (7 лет)" => "84",
        "90 мес. (7.5 лет)" => "90",
        "96 мес. (8 лет)" => "96",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "PrivatePersonApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "private_person",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PPDocsPassRFApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PhoneApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "phone",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PPDocsDriversLicenseApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "pp_docs_drivers_license",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PPDocsDriversLicenseAnotherApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "pp_docs_drivers_license_another",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PPFamilyApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "pp_family",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "AddressApplicationID" => [
      "sTableField" => "application_id",
      "sTable" => "address",
      "sTableType" => "INT",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "number"
        ],
      ],
    ],    
    "PersonLastName" => [
      "sTableField" => "last_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Фамилия",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic"
        ],
      ],
    ],
    "PersonFirstName" => [
      "sTableField" => "first_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Имя",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic"
        ],
      ],
    ],
    "PersonFatherName" => [
      "sTableField" => "father_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Отчество",
      "aValidation" => [
      ],
    ],
    "PersonGender" => [
      "sTableField" => "gender",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "RadioGroupField",
      "sLabel" => "Пол",
      "aItems" => [
        "Муж" => "male",
        "Жен" => "female",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "PersonBirthdate" => [
      "sTableField" => "birthdate",
      "sTable" => "private_person",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата рождения",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.1950",
          "max" => "now",
        ],
      ],
    ],
    "PersonPassportSeries" => [
      "sTableField" => "series",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Серия",
      "sMask" => "9999",
      "aValidation" => [
        "required" => true,
        "min" => "4",
        "max" => "4",
        "symbols" => [
        "number",
        ]
      ],
    ],
    "PersonPassportNumberDoc" => [
      "sTableField" => "number_doc",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Номер",
      "sMask" => "999999",
      "aValidation" => [
        "required" => true,
        "min" => "6",
        "max" => "6",
        "symbols" => [
        "number",
        ],
      ],
    ],
    "PersonBirthplace" => [
      "sTableField" => "birthplace",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Место рождения",
      "aValidation" => [
        "required" => true,
        "symbols" => [
        "cyrillic",
        "number",
        "spaces",
        "punctuation",
        ],
      ],
    ],
    "PersonPhone" => [
      "sTableField" => "number_phone",
      "sTable" => "phone",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Мобильный телефон",
      "sMask" => "+7(999)999-99-99",
      "aValidation" => [
        "required" => true,
        "phone" => true,
      ],
    ], 
    "PersonPassportIssueDate" => [
      "sTableField" => "issue_date",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата выдачи",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.1950",
          "max" => "now",
        ],
      ],
    ],
    "PersonPassportIssueCode" => [
      "sTableField" => "issue_code",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Код подразделения",
      "sMask" => "999-999",
      "aValidation" => [
        "required" => true,
        "issue_code" => true,
      ],
    ],
    "PersonPassportIssuePlace" => [
      "sTableField" => "issue_place",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Кем выдан",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic",
          "number",
          "spaces",
          "punctuation",
        ],
      ],
    ],
    "PersonHasDriverLicense" => [
      "sTableField" => "is_drive_license",
      "sTable" => "private_person",
      "sTableType" => "INT",
      "sComponentType" => "RadioGroupField",
      "sLabel" => "Наличие водительского удостоверения",
      "aItems" => [
        "Да" => "1",
        "Нет" => "0",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "PersonDriverLicenseType" => [
      "sTableField" => "driver_license_type",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "SelectboxField",
      "sLabel" => "Тип водительского удостоверения",
      "aItems" => [
        "Водительское удостоверение РФ" => "driver_license",
        "Водительское удостоверение (Иное)" => "driver_license_another",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "PersonDriveSeries" => [
      "sTableField" => "series_drive",
      "sTable" => "pp_docs_drivers_license",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Серия",
      "sMask" => "99**",
      "aValidation" => [
        "required" => true,
        "min" => 4,
        "drive_series" => true,
      ],
    ],
    "PersonDriveDocumentNumber" => [
      "sTableField" => "number_doc_drive",
      "sTable" => "pp_docs_drivers_license",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Номер",
      "sMask" => "999999",
      "aValidation" => [
        "required" => true,
        "min" => 6,
        "symbols" => [
          "number"
        ],
      ],
    ],
    "PersonDriveIssueDate" => [
      "sTableField" => "issue_date_drive",
      "sTable" => "pp_docs_drivers_license",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата выдачи",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.2000",
          "max" => "now",
        ]
      ],
    ],
    "PersonDriveIssuePlace" => [
      "sTableField" => "issue_place_drive",
      "sTable" => "pp_docs_drivers_license",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Кем выдан",
      "aValidation" => [
        "required" => true,
        "symbols" => [
        "cyrillic",
        "number",
        "spaces",
        "punctuation",
        ],
      ],
    ],
    "PersonAnotherDriveSeries" => [
      "sTableField" => "series_drive",
      "sTable" => "pp_docs_drivers_license_another",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Серия/Номер",
      "aValidation" => [
        "required" => true,
      ],
    ],
    "PersonAnotherDriveIssueDate" => [
      "sTableField" => "issue_date_drive",
      "sTable" => "pp_docs_drivers_license_another",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата выдачи",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.2000",
          "max" => "now",
        ]
      ],
    ],
    "PersonAnotherDriveIssuePlace" => [
      "sTableField" => "issue_place_drive",
      "sTable" => "pp_docs_drivers_license_another",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Кем выдан",
      "aValidation" => [
        "required" => true,
        "symbols" => [
        "cyrillic",
        "number",
        "spaces",
        "punctuation",
        ],
      ],
    ],    
    "PersonRelationDegree" => [
      "sTableField" => "relative_type",
      "sTable" => "pp_family",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "SelectboxField",
      "sLabel" => "Степень родства",
      "aItems" => [
        "Супруг" => "spouse",
        "Супруга" => "wife",
        "Сын/Дочь" => "child",
        "Отец/Мать" => "parent",
        "Брат/Сестра" => "sibling",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "DriverLastName" => [
      "sTableField" => "last_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Фамилия",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic"
        ],
      ],
    ],
    "DriverFirstName" => [
      "sTableField" => "first_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Имя",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic"
        ],
      ],
    ],
    "DriverFatherName" => [
      "sTableField" => "father_name",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Отчество",
      "aValidation" => [
      ],
    ],
    "DriverGender" => [
      "sTableField" => "gender_driver",
      "sTable" => "private_person",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "RadioGroupField",
      "sLabel" => "Пол",
      "aItems" => [
        "Муж" => "male",
        "Жен" => "female",
      ],
      "aValidation" => [
        "required" => true,
      ],
    ],
    "DriverBirthdate" => [
      "sTableField" => "birthdate_driver",
      "sTable" => "private_person",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата рождения",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.1950",
          "max" => "now",
        ],
      ],
    ],
    "DriverPassportSeries" => [
      "sTableField" => "series_driver",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Серия",
      "sMask" => "9999",
      "aValidation" => [
        "required" => true,
        "min" => "4",
        "max" => "4",
        "symbols" => [
        "number",
        ],
      ],
    ],    
    "DriverPassportDocumentNumber" => [
      "sTableField" => "number_doc_driver",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "INT",
      "sComponentType" => "TextField",
      "sLabel" => "Номер",
      "sMask" => "999999",
      "aValidation" => [
        "required" => true,
        "min" => "6",
        "max" => "6",
        "symbols" => [
        "number",
        ],
      ],
    ],
    "DriverPassportIssueDate" => [
      "sTableField" => "issue_date_driver",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата выдачи",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.1950",
          "max" => "now",
        ],
      ],
    ],
    "DriverPassportIssuePlace" => [
      "sTableField" => "issue_place_driver",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Кем выдан",
      "aValidation" => [
        "required" => true,
        "symbols" => [
        "cyrillic",
        "number",
        "spaces",
        "punctuation",
        ],
      ],
    ],    
    "DriverPassportIssueCode" => [
      "sTableField" => "issue_code_driver",
      "sTable" => "pp_docs_pass_rf",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Код подразделения",
      "sMask" => "999-999",
      "aValidation" => [
        "required" => true,
        "issue_code" => true,
      ],
    ],
    "PersonRegistrationAddress" => [
      "sTableField" => "full_address",
      "sTable" => "address",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Адрес регистрации",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic",
          "number",
          "spaces",
          "punctuation",
        ],
      ],
    ],
    "PersonRegistrationDate" => [
      "sTableField" => "registration_date",
      "sTable" => "private_person",
      "sTableType" => "DATETIME",
      "sComponentType" => "TextField",
      "sLabel" => "Дата регистрации",
      "sMask" => "99.99.9999",
      "aValidation" => [
        "required" => true,
        "date" => [
          "min" => "01.01.1950",
          "max" => "now",
        ],
      ],
    ],
    "PersonHasSameAddress" => [
      "sTableField" => "is_same_address",
      "sTable" => "private_person",
      "sTableType" => "INT",
      "sComponentType" => "CheckboxField",
      "sLabel" => "Совпадает с адресом места жительства",
      "aValidation" => [
      ]
    ],
    "PersonResidenceAddress" => [
      "sTableField" => "full_address",
      "sTable" => "address",
      "sTableType" => "VARCHAR(255)",
      "sComponentType" => "TextField",
      "sLabel" => "Адрес проживания",
      "aValidation" => [
        "required" => true,
        "symbols" => [
          "cyrillic",
          "number",
          "spaces",
          "punctuation",
        ],
      ],
    ],    
  ],
  'aDatabase' => [
    'sDatabaseName' => './db/store.db',
    'sTablePrefix' => '',
  ],
];
