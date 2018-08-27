<?php
setlocale(LC_ALL, 'C.UTF-8');

class Application {
  private $aFields = [
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
  ];

  public function fnValidateFields($oFieldData)
  {
    $aResult = [
      'errors' => [
      ]
    ];

    foreach($oFieldData as $aField) {
      
      $sField = $aField['sField'];

      if (!isset($this->aFields[$sField])) {
        $aResult['errors'][$sField][] = "Поле $sField не найдено";
      }

      if (!isset($this->aFields[$sField]['aValidation'])) {
        continue;
      }

      $bRequired = $this->aFields[$sField]['aValidation']['required'];
      if (empty($aField['sValue'])) {
        if ($bRequired) {
          $aResult['errors'][$sField][] = "Поле не должно быть пустым";
        }
        continue;
      } 

      foreach ($this->aFields[$sField]['aValidation'] as $aValidatorName => $aValidatorOptions) {
        switch ($aValidatorName) {
          case 'min':
            if (mb_strlen($aField['sValue'])<$aValidatorOptions) {
              $aResult['errors'][$sField][] = "Значение поля не должно быть меньше $aValidatorOptions символов";
            }
            break;
          case 'max':
            if (mb_strlen($aField['sValue'])>$aValidatorOptions) {
              $aResult['errors'][$sField][] = "Значение поля не должно быть больше $aValidatorOptions символов";
            }
            break;
          case 'symbols':
            $sRegexp = "";

            foreach ($aValidatorOptions as $aSymbols) {
              switch ($aSymbols) {
                case "cyrillic":
                  $sRegexp .= "а-яА-ЯёЁ";
                  break;
                case "latin":
                  $sRegexp .= "a-zA-Z";
                  break;
                case "number":
                  $sRegexp .= "0-9";
                  break;
                case "spaces":
                  $sRegexp .= "\s\t";
                  break;
                case "punctuation":
                  // General Punctuation block is \u2000-\u206F
                  // Supplemental Punctuation block is \u2E00-\u2E7F
                  $sRegexp .= "\x{2000}-\x{206F}\x{2E00}-\x{2E7F}\-_.+!*'(),{}|\\^~\[\]`<>#%\";\/?:@&=$";
                  break;
                case "integer":
                  $sRegexp .= "\-0-9";
                  break;
                case "float":
                  $sRegexp .= "\-0-9.,eE";
                  break;
                default:
                  $sRegexp .= $aSymbols;
                  break;
              }
            }

            if (!preg_match("/^[$sRegexp]*$/u", $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Поле содержит запрещенные сиволы";
            }

            break;
          case 'range':          
            $iValue = intVal($aField['sValue']);

            if (isset($aValidatorOptions["min"])) {
              if ($iValue < $aValidatorOptions["min"]) {
                $aResult['errors'][$sField][] = "Число не должно быть меньше {$aValidatorOptions["min"]}"; 
                break;
              }
            }

            if (isset($aValidatorOptions["max"])) {
              if ($iValue > $aValidatorOptions["max"]) {
                $aResult['errors'][$sField][] = "Число не должно быть больше {$aValidatorOptions["max"]}"; 
                break;
              }
            }

            break;
          case 'date':
            $sRegexp = "/\d?\d\.\d?\d\.\d\d\d\d/";

            if (!preg_match($sRegexp, $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Неверный формат даты"; 
              break;
            }

            $iDate = strtotime($aField['sValue']);

            if ($iDate == -1) {
              $aResult['errors'][$sField][] = "Неверный формат даты"; 
              break;
            }

            if (is_array($aValidatorOptions)) {
              $iMinDate = strtotime($aValidatorOptions["min"]);
              $iMaxDate = strtotime($aValidatorOptions["max"]); 

              if ($iDate<$iMinDate || $iDate>$iMaxDate) {
                $aResult['errors'][$sField][] = "Дата вне диапозона";
              }
            }
            break;
          case 'email':
            $sRegexp = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

            if (!preg_match($sRegexp, $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Неверный формат e-mail";
            }
            break;
          case 'phone':
            $sRegexp = "/^\s*(\+[1-9]|8)?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/";

            if (!preg_match($sRegexp, $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Не верный формат телефона +0 (000) 000-00-00";
            }
            break;
          case 'initial_fee':
            if (!isset($oFieldData['CarPrice']))
              break;
            
            $iInitialFee = intVal($aField['sValue']);
            $iCarPrice = intVal($oFieldData['CarPrice']['sValue']);
            
            if ($iInitialFee>$iCarPrice) {
              $aResult['errors'][$sField][] = "Первоначальный взнос не может быть больше цены автомобиля";
            }   
            break;
          case 'issue_code':
            $sRegexp = "/^\d\d\d-\d\d\d$/";

            if (!preg_match($sRegexp, $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Неверный код подразделения";
            }          
            break;
          case 'drive_series':
            $sRegexp = "/^\d\d[a-zA-Zа-яА-ЯёЁ][a-zA-Zа-яА-ЯёЁ]$/";

            if (!preg_match($sRegexp, $aField['sValue'])) {
              $aResult['errors'][$sField][] = "Неверный формат серии";
            }          
            break;
        }
      }
      
    }
    
    return $aResult;
  }

  public function fnProcess()
  {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
      $aResult = [
          'status' => 'error',
          'errors' => []
      ];

      if ($_REQUEST['sAction'] == 'get') {
        // Read from database
        $aResult['data'] = [
            [
                'sField' => 'Phone',
                'sValue' => '123-12-12'
            ],
            [
                'sField' => 'Email',
                'sValue' => 'h@h.ru'
            ]
        ];
      }

      if ($_REQUEST['sAction'] == 'validate') {
        $aResult = array_merge_recursive($aResult, $this->fnValidateFields([ $_REQUEST['oData'] ]));
      }

      if ($_REQUEST['sAction'] == 'post') {
        $aResult = array_merge_recursive($aResult, $this->fnValidateFields($_REQUEST['oData']));

        if (!count($aResult['errors'])) {
          // Write to database
        }
      }

      if (!count($aResult['errors']))
        $aResult['status'] = 'success';

      header('Content-Type: application/json');
      echo json_encode($aResult);
    } else {
      if (!isset($_REQUEST['c'])) {
        header("Location: /?c=NanoProfileApplication");
      }
      include "index.html";
    }
  }
}

$oApplication = new Application();
$oApplication->fnProcess();