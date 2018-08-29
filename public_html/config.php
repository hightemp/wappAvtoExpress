<?php

function config($sKey, $sDefaultValue='')
{
  $aConfig = include "config.php";
  
  return isset($aConfig[$sKey]) ? $aConfig[$sKey] : $sDefaultValue;
}

return [
    'aFields' => [
      "CarPrice" => [
          "sTableField" => "car_price",
          "sTable" => "application",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonLastName" => [
          "sTableField" => "last_name",
          "sTable" => "private_person",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonBirthdate" => [
          "sTableField" => "birthdate",
          "sTable" => "private_person",
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
          "aValidation" => [
              "required" => true,
              "phone" => true,
          ],
      ], 
      "PersonPassportIssueDate" => [
          "sTableField" => "issue_date",
          "sTable" => "pp_docs_pass_rf",
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
          "aValidation" => [
              "required" => true,
              "issue_code" => true,
          ],
      ],
      "PersonPassportIssuePlace" => [
          "sTableField" => "issue_place",
          "sTable" => "pp_docs_pass_rf",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonDriverLicenseType" => [
          "sTableField" => "driver_license_type",
          "sTable" => "private_person",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonDriveSeries" => [
          "sTableField" => "series_drive",
          "sTable" => "pp_docs_drivers_license",
          "aValidation" => [
              "required" => true,
              "min" => 4,
              "drive_series" => true,
          ],
      ],
      "PersonDriveDocumentNumber" => [
          "sTableField" => "number_doc_drive",
          "sTable" => "pp_docs_drivers_license",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonAnotherDriveIssueDate" => [
          "sTableField" => "issue_date_drive",
          "sTable" => "pp_docs_drivers_license_another",
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
          "aValidation" => [
              "required" => true,
          ],
      ],
      "DriverLastName" => [
          "sTableField" => "last_name",
          "sTable" => "private_person",
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
          "aValidation" => [
          ],
      ],
      "DriverGender" => [
          "sTableField" => "gender_driver",
          "sTable" => "private_person",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "DriverBirthdate" => [
          "sTableField" => "birthdate_driver",
          "sTable" => "private_person",
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
          "aValidation" => [
              "required" => true,
              "issue_code" => true,
          ],
      ],
      "PersonRegistrationAddress" => [
          "sTableField" => "full_address",
          "sTable" => "address",
          "aValidation" => [
              "required" => true,
          ],
      ],
      "PersonRegistrationDate" => [
          "sTableField" => "registration_date",
          "sTable" => "private_person",
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
          "aValidation" => [
          ]
      ],
      "PersonResidenceAddress" => [
          "sTableField" => "full_address",
          "sTable" => "address",
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
