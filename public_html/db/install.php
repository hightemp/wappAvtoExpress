<?php

include "../config.php";

$oPDO = new PDO('sqlite:'.basename(config('aDatabase')['sDatabaseName']));
$oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$aFields = config('aFields');

$aFieldsGroupedByTables = [];

foreach ($aFields as $aField) {
  $aFieldsGroupedByTables[$aField['sTable']][$aField['sTableField']] = $aField['sTableType'];
}

foreach ($aFieldsGroupedByTables as $sTableName => $aFields) {
  $oPDO->exec("DROP TABLE IF EXISTS `$sTableName`");
  
  $sFields = [];
  
  foreach ($aFields as $sFieldName => $sFieldType) {
    $sFieldType = strtoupper($sFieldType);
    $sFields[] = "$sFieldName $sFieldType NOT NULL ".(strpos("INT", $sFieldType)!==false ? "DEFAULT '0'" : "DEFAULT ''");
  }
  
  $sFields = implode(",", $sFields);
  
  $oPDO->exec(
    "
    CREATE TABLE 
      `$sTableName` 
    (
      {$sTableName}_id INTEGER PRIMARY KEY AUTOINCREMENT,
      $sFields
    )
    "
  );
}