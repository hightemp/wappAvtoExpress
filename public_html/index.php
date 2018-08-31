<?php
setlocale(LC_ALL, 'C.UTF-8');
date_default_timezone_set('UTC');

include_once "validator.php";
include "config.php";

class Application 
{
  public function fnPackFields($sTableName, $aData, $aScheme)
  {
    $aResult = [];
    
    foreach ($aScheme as $sSchemeFieldName => $aSchemeField) {
      if (isset($aData[$aSchemeField['sTableField']]) && $aSchemeField['sTable'] == $sTableName) {
        $aResult[] = [
          'sField' => $sSchemeFieldName,
          'sValue' => $aData[$aSchemeField['sTableField']]            
        ];
      }
    }
    
    return $aResult;
  }
  
  public function fnPrepareFieldsForTable($oPDO, $sTableName, $aFieldData, $aScheme)
  {
    $aResult = [];
    
    foreach ($aScheme as $sSchemeFieldName => $aSchemeField) {
      if (isset($aFieldData[$sSchemeFieldName]) && $aSchemeField['sTable'] == $sTableName) {
        $aResult[] = "{$aSchemeField['sTableField']} = '{$oPDO->quote($aFieldData[$sSchemeFieldName]['sValue'])}'";
      }
    }
    
    return implode(",", $aResult);
  }
  
  public function fnProcess()
  {
    $oPDO = new PDO('sqlite:'.config('aDatabase')['sDatabaseName']);
    $oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
      $aResult = [
          'status' => 'error',
          'errors' => []
      ];

      if ($_REQUEST['sAction'] == 'getApplicationData') {
        $iApplicationID = intVal($_REQUEST['iApplicationID']);
        $aTables = [
          "private_person", 
          "pp_docs_pass_rf",
          "phone",
          "pp_docs_drivers_license",
          "pp_docs_drivers_license_another",
          "pp_family",
          "address",
        ];
        $aResult['aData'] = [];

        foreach ($aTables as $sTableName) {
          $aData = $oPDO->query("SELECT * FROM $sTableName WHERE application_id = $iApplicationID");
          $aResult['aData'] = array_merge($aResult['aData'], $this->fnPackFields($sTableName, $aData, config('aFields')));
        }
      }

      if ($_REQUEST['sAction'] == 'getApplicationFields') {
        $aFields = config('aApplicationsFields')[$_REQUEST['sType']];
        
        $aResult['oFields'] = [];
        
        foreach ($aFields as $sFieldName) {
          $aField = config('aFields')[$sFieldName];
          $aResult['oFields'][$sFieldName] = [];
          
          foreach ($aField as $sKey => $mValue) {
            if (in_array($sKey, config('aAvailableFieldsClientData'))) {
              $aResult['oFields'][$sFieldName][$sKey] = $mValue;
            }
          }
        }
      }

      if ($_REQUEST['sAction'] == 'validate') {
        $aResult = array_merge_recursive($aResult, Validator::fnValidateFields([ $_REQUEST['oData'] ], config('aFields')));
      }

      if ($_REQUEST['sAction'] == 'post') {
        $aResult = array_merge_recursive($aResult, Validator::fnValidateFields($_REQUEST['oData'], config('aFields')));

        if (!count($aResult['errors'])) {
          if ($_REQUEST['sType']=='Short') {
            $oPDO->exec(
              "
              INSERT INTO 
                application
              SET
                {$this->fnPrepareFieldsForTable($oPDO, 'application', $_REQUEST['oData'], config('aFields'))}
              "
            );
            
            $iApplicationID = $oPDO->lastInsertId();
            $aTables = [
              "private_person", 
              "pp_docs_pass_rf",
              "phone",
              "pp_docs_drivers_license",
              "pp_docs_drivers_license_another",
              "pp_family",
              "address",
            ];
            
            foreach ($aTables as $sTableName) {
              $oPDO->exec(
                "
                INSERT INTO 
                  $sTableName
                SET
                  application_id = $iApplicationID,
                  {$this->fnPrepareFieldsForTable($oPDO, $sTableName, $_REQUEST['oData'], config('aFields'))}
                "
              );
            }
          }
          
          if ($_REQUEST['sType']=='Full') {
            $iApplicationID = intVal($_REQUEST['iApplicationID']);
            $aTables = [
              "private_person", 
              "pp_docs_pass_rf",
              "phone",
              "pp_docs_drivers_license",
              "pp_docs_drivers_license_another",
              "pp_family",
              "address",
            ];
            
            foreach ($aTables as $sTableName) {
              $oPDO->exec(
                "
                UPDATE 
                  $sTableName
                SET
                  {$this->fnPrepareFieldsForTable($oPDO, $sTableName, $_REQUEST['oData'], config('aFields'))}
                WHERE
                  application_id = $iApplicationID
                "
              );
            }
          }
        }
      }

      if (!count($aResult['errors']))
        $aResult['status'] = 'success';

      header('Content-Type: application/json');
      die(json_encode($aResult));
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