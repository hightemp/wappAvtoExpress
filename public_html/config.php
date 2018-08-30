<?php

if (!function_exists('config')) {
  function config($sKey, $sDefaultValue='')
  {
    $aConfig = include "config.php";

    return isset($aConfig[$sKey]) ? $aConfig[$sKey] : $sDefaultValue;
  }
}

return [
    'aFields' => [
      "CarPrice" => [
          "sTableField" => "car_price",
          "sTable" => "application",
          "sTableType" => "INT",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonLastName" => [
          "sTableField" => "last_name",
          "sTable" => "private_person",
          "sTableType" => "VARCHAR(255)",
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
          "aValidation" => [
              "required" => false,
              "symbols" => [
                  "cyrillic"
              ],
          ],
      ],
      "PersonGender" => [
          "sTableField" => "gender",
          "sTable" => "private_person",
          "sTableType" => "VARCHAR(255)",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonBirthdate" => [
          "sTableField" => "birthdate",
          "sTable" => "private_person",
          "sTableType" => "DATETIME",
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
          "aValidation" => [
              "required" => true,
              "phone" => true,
          ],
      ], 
      "PersonPassportIssueDate" => [
          "sTableField" => "issue_date",
          "sTable" => "pp_docs_pass_rf",
          "sTableType" => "DATETIME",
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
          "aValidation" => [
              "required" => true,
              "issue_code" => true,
          ],
      ],
      "PersonPassportIssuePlace" => [
          "sTableField" => "issue_place",
          "sTable" => "pp_docs_pass_rf",
          "sTableType" => "VARCHAR(255)",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonDriverLicenseType" => [
          "sTableField" => "driver_license_type",
          "sTable" => "private_person",
          "sTableType" => "VARCHAR(255)",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonDriveSeries" => [
          "sTableField" => "series_drive",
          "sTable" => "pp_docs_drivers_license",
          "sTableType" => "VARCHAR(255)",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonAnotherDriveIssueDate" => [
          "sTableField" => "issue_date_drive",
          "sTable" => "pp_docs_drivers_license_another",
          "sTableType" => "DATETIME",
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
      "PersonRalationDegree" => [
          "sTableField" => "relative_type",
          "sTable" => "pp_family",
          "sTableType" => "VARCHAR(255)",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "DriverLastName" => [
          "sTableField" => "last_name",
          "sTable" => "private_person",
          "sTableType" => "VARCHAR(255)",
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
          "aValidation" => [
          ],
      ],
      "DriverGender" => [
          "sTableField" => "gender_driver",
          "sTable" => "private_person",
          "sTableType" => "VARCHAR(255)",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "DriverBirthdate" => [
          "sTableField" => "birthdate_driver",
          "sTable" => "private_person",
          "sTableType" => "DATETIME",
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
          "aValidation" => [
              "required" => true,
              "issue_code" => true,
          ],
      ],
      "PersonRegistrationAddress" => [
          "sTableField" => "full_address",
          "sTable" => "address",
          "sTableType" => "VARCHAR(255)",
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
          "aValidation" => [
          ]
      ],
      "PersonResidenceAddress" => [
          "sTableField" => "full_address",
          "sTable" => "address",
          "sTableType" => "VARCHAR(255)",
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
    ],
];
