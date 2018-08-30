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

/*
$oPDO->exec("DROP TABLE IF EXISTS `application`");
$oPDO->exec(
  "
  CREATE TABLE 
    `application` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    car_price INT NOT NULL DEFAULT '0',
    credit_initial INT NOT NULL DEFAULT '0',
    credit_term INT NOT NULL DEFAULT '0'
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `private_person`");
$oPDO->exec(
  "
  CREATE TABLE 
    `private_person` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    last_name VARCHAR(255) NOT NULL DEFAULT '',
    first_name VARCHAR(255) NOT NULL DEFAULT '',
    father_name VARCHAR(255) NOT NULL DEFAULT '',
    gender VARCHAR(255) NOT NULL DEFAULT '',
    birthdate DATETIME NOT NULL DEFAULT '',
    birthplace VARCHAR(255) NOT NULL DEFAULT '',
    is_drive_license INT NOT NULL DEFAULT '0',
    driver_license_type VARCHAR(255) NOT NULL DEFAULT '',
    gender_driver VARCHAR(255) NOT NULL DEFAULT '',
    birthdate_driver DATETIME NOT NULL DEFAULT '',
    registration_date DATETIME NOT NULL DEFAULT '',
    is_same_address INT NOT NULL DEFAULT '0'
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `pp_docs_pass_rf`");
$oPDO->exec(
  "
  CREATE TABLE 
    `pp_docs_pass_rf` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    series INT NOT NULL DEFAULT '0',
    number_doc INT NOT NULL DEFAULT '0',
    issue_date DATETIME NOT NULL DEFAULT '',
    issue_code VARCHAR(255) NOT NULL DEFAULT '',
    issue_place VARCHAR(255) NOT NULL DEFAULT '',
    series_driver INT NOT NULL DEFAULT '0',
    number_doc_driver INT NOT NULL DEFAULT '0',
    issue_date_driver DATETIME NOT NULL DEFAULT '',
    issue_place_driver VARCHAR(255) NOT NULL DEFAULT '',
    issue_code_driver VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `phone`");
$oPDO->exec(
  "
  CREATE TABLE 
    `phone` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    number_phone VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `pp_docs_drivers_license`");
$oPDO->exec(
  "
  CREATE TABLE 
    `pp_docs_drivers_license` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    series_drive VARCHAR(255) NOT NULL DEFAULT '',
    number_doc_drive INT NOT NULL DEFAULT '0',
    issue_date_drive DATETIME NOT NULL DEFAULT '',
    issue_place_drive VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `pp_docs_drivers_license_another`");
$oPDO->exec(
  "
  CREATE TABLE 
    `pp_docs_drivers_license_another` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    series_drive VARCHAR(255) NOT NULL DEFAULT '',
    issue_date_drive DATETIME NOT NULL DEFAULT '',
    issue_place_drive VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `pp_family`");
$oPDO->exec(
  "
  CREATE TABLE 
    `pp_family` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    relative_type VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);

$oPDO->exec("DROP TABLE IF EXISTS `address`");
$oPDO->exec(
  "
  CREATE TABLE 
    `address` 
  (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    full_address VARCHAR(255) NOT NULL DEFAULT ''
  )
  "
);
 * 
 */