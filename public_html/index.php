<?php
setlocale(LC_ALL, 'C.UTF-8');
date_default_timezone_set('UTC');

include_once "validator.php";
include "config.php";

class Application 
{
  public function fnProcess()
  {
    $oPDO = new PDO('sqlite:'.config('aDatabase')['sDatabaseName']);
    $oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
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
        $aResult = array_merge_recursive($aResult, Validator::fnValidateFields([ $_REQUEST['oData'] ], config('aFields')));
      }

      if ($_REQUEST['sAction'] == 'post') {
        $aResult = array_merge_recursive($aResult, Validator::fnValidateFields($_REQUEST['oData']), config('aFields'));

        if (!count($aResult['errors'])) {
          if (in_array($_REQUEST['sType'], ['Short', 'Full'])) {
            
          }
          // Write to database
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