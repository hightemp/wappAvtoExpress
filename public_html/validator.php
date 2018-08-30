<?php

class Validator
{
  
  public static function fnValidateFields($oFieldData, $aScheme)
  {
    $aResult = [
      'errors' => [
      ]
    ];

    foreach($oFieldData as $aField) {
      
      $sField = $aField['sField'];

      if (!isset($aScheme[$sField])) {
        $aResult['errors'][$sField][] = "Поле $sField не найдено";
      }

      if (!isset($aScheme[$sField]['aValidation'])) {
        continue;
      }

      $bRequired = $aScheme[$sField]['aValidation']['required'];
      if (trim($aField['sValue']) == "") {
        if ($bRequired) {
          $aResult['errors'][$sField][] = "Поле не должно быть пустым";
        }
        continue;
      } 

      foreach ($aScheme[$sField]['aValidation'] as $aValidatorName => $aValidatorOptions) {
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
  
}
