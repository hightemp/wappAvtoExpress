<?php

class Database 
{
  protected static $_oInstance;
  protected $_oPDO;
  protected $_sTablePrefix;
  
  public static function fnGetInstance()
  {
    if (!self::$_oInstance) {
      self::$_oInstance = new static();
    }
    
    return self::$_oInstance;
  }
  
  public static function __callStatic($sMethodName, $aParameters)
  {
    if ($sMethodName=="fnGetInstance")
      return self::fnGetInstance();
    
    return self::fnGetInstance()->$sMethodName(...$aParameters);
  }

  public function __construct()
  {
    $this->fnConnect();
  }
  
  public function fnConnect()
  {
    $this->_oPDO = new PDO('sqlite:'.config('aDatabase')['sDatabaseName']);
    $this->_oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->_sTablePrefix = config('aDatabase')['sTablePrefix'];
  }
  
  public function fnGetArray($sSQL, ...$aArguments)
  {
    $sSQL = $this->fnProcess($sSQL, $aArguments);
    
    return $this->_oPDO->query($sSQL);
  }

  public function fnGetRow($sSQL, ...$aArguments)
  {
    return $this->fnGetArray($sSQL, ...$aArguments)[0];
  }
  
  public function fnGetField($sSQL, ...$aArguments)
  {
    $sSQL = $this->fnProcess($sSQL, $aArguments);
    
    return $this->_oPDO->query($sSQL, PDO::FETCH_NUM)[0][0];
  }

  public function fnQuery($sSQL, ...$aArguments)
  {
    $sSQL = $this->fnProcess($sSQL, $aArguments);
    $this->_oPDO->exec($sSQL);
    
    return $this->_oPDO->lastInsertId();
  }
  
  public function fnEscape($sValue)
  {
    return $this->_oPDO->quote($sValue);
  }
  
  public function fnProcess($sSQL, $aData = array())
  {
    $this->_aReplaceData = $aData;
    $this->iMatchesCount = 0;
    $sSQL = str_replace('?:', $this->_sTablePrefix, $sSQL);
    $sSQL = preg_replace_callback("/\?(i|s|l|d|a|n|u|e|m|p|w|f)+/", [$this, "fnReplacePatterns"], $sSQL);
    return $sSQL;
  }
  
  protected function fnReplacePatterns($aMatches)
  {
    $sResult = '';
    $sPattern = $aMatches[0];
    $sLetter = $aMatches[1];
    $sCurrentValue = $this->_aReplaceData[$this->iMatchesCount];
    switch ($sLetter) {
      case 'i':
        $sResult = intVal($sCurrentValue);
        break;
      case 's':
        $sCurrentValue = $this->fnEscape($sCurrentValue);
        $sResult = "'$sCurrentValue'";
        break;
      case 'l':
        $sCurrentValue = str_replace("\\", "\\\\", $sCurrentValue);
        $sCurrentValue = $this->fnEscape($sCurrentValue);
        $sResult = "'$sCurrentValue'";
        break;
      case 'd':
        if ($sCurrentValue == INF) {
            $sCurrentValue = PHP_INT_MAX;
        }
        $sResult = sprintf('%01.2f', $sCurrentValue);
      break;
      case 'a':
        $sCurrentValue = $this->fnFilterData($sCurrentValue, true, true);
        $sResult = implode(', ', $sCurrentValue);
        break;
      case 'n':
        $sCurrentValue = $this->fnFilterData($sCurrentValue, true, true);
        $sCurrentValue = array_map('intVal', $sCurrentValue);
        $sResult = implode(', ', $sCurrentValue);
        break;
      case 'u':
        $sCurrentValue = $this->fnFilterData($sCurrentValue, false);
        $sResult = implode(', ', $sCurrentValue);
        break;
      case 'p':
        $sResult = str_replace('?:', $this->_sTablePrefix, $sCurrentValue);
        break;
    }
    $this->iMatchesCount++;
    return $sResult;
  }
  
  protected function fnFilterData($aData, $bUseKeyValue, $bUseForceQuote = false)
  {
      $aFiltered = array();
      if (!is_array($aData))
        $aData = [$aData];
      foreach ($aData as $sKey => $sValue) {
          $sValue = $this->fnPrepareValue($sValue, $bUseForceQuote);
          if ($bUseKeyValue) {
              $aFiltered[$sKey] = $sValue;
          } else {
              $aFiltered[] = "`$sKey` = $sValue";
          }
      }
      return $aFiltered;
  }
  
  protected function fnPrepareValue($sValue, $bUseForceQuote = false)
  {
      if ($bUseForceQuote) {
          $sValue = "'" . $this->fnEscape($sValue) . "'";
      } elseif (is_int($sValue) || is_float($sValue)) {
          //ok
      } elseif (is_numeric($sValue) && $sValue === strval($sValue + 0)) {
          $sValue += 0;
      } elseif (is_null($sValue)) {
          $sValue = 'NULL';
      } else {
          $sValue = "'" . $this->fnEscape($sValue) . "'";
      }
      return $sValue;
  }
 
}
