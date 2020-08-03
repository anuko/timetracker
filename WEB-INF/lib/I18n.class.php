<?php
// +----------------------------------------------------------------------+
// | Anuko Time Tracker
// +----------------------------------------------------------------------+
// | Copyright (c) Anuko International Ltd. (https://www.anuko.com)
// +----------------------------------------------------------------------+
// | LIBERAL FREEWARE LICENSE: This source code document may be used
// | by anyone for any purpose, and freely redistributed alone or in
// | combination with other software, provided that the license is obeyed.
// |
// | There are only two ways to violate the license:
// |
// | 1. To redistribute this code in source form, with the copyright
// |    notice or license removed or altered. (Distributing in compiled
// |    forms without embedded copyright notices is permitted).
// |
// | 2. To redistribute modified versions of this code in *any* form
// |    that bears insufficient indications that the modifications are
// |    not the work of the original author(s).
// |
// | This license applies to this document only, not any other software
// | that it may be combined with.
// |
// +----------------------------------------------------------------------+
// | Contributors:
// | https://www.anuko.com/time_tracker/credits.htm
// +----------------------------------------------------------------------+

class I18n {
  var $lang = 'en'; // Language for the class.
  var $defaultLang = 'en'; // English is the default language.
  var $monthNames;
  var $weekdayNames;
  var $weekdayShortNames;
  var $keys = array(); // These are our localized strings.

  // get - obtains a localized value from $keys array.
  function get($key) {
    $value = '';
    $pos = strpos($key, '.'); // Keywords can have separating dots such as in form.login.about.
    if (!($pos === false)) {
      $words = explode('.', $key);
      $str = '';
      foreach ($words as $word) {
        $str .= "['".$word."']";
      }
      eval("\$value = \$this->keys".$str.";");
    } else {
      $value = $this->keys[$key];
    }
    return $value;
  }

  // load - loads localized strings into $keys array by first going through the default file (en.lang.php)
  // and then through the requested language file (which is supplied as parameter).
  // This means we end up with default English strings when keys are missing in the translation file.
  function load($langName) {
    // Load default English keys first.
    $defaultFileName = RESOURCE_DIR . '/' . $this->defaultLang . '.lang.php';
    if (file_exists($defaultFileName)) {
      include($defaultFileName);

      $this->monthNames = $i18n_months;
      $this->weekdayNames = $i18n_weekdays;
      $this->weekdayShortNames = $i18n_weekdays_short;

      foreach ($i18n_key_words as $kword=>$value) {
        $pos = strpos($kword, ".");
        if (!($pos === false)) {
          $p = explode(".", $kword);
          $str = "";
          foreach ($p as $w) {
            $str .= "[\"".$w."\"]";
          }
          eval("\$this->keys".$str."='".$value."';");
        } else {
          $this->keys[$kword] = $value;
        }
      }
    }

    // Now load the keys from the requested file.
    // This overwrites already loaded English strings.
    $requestedFileName = strtolower($langName) . '.lang.php';
    $requestedFileName = RESOURCE_DIR . '/' . $requestedFileName;
    if (file_exists($requestedFileName) && ($langName != $this->defaultLang)) {
      require($requestedFileName);

      $this->lang = $langName;
      $this->monthNames = $i18n_months;
      $this->weekdayNames = $i18n_weekdays;
      $this->weekdayShortNames = $i18n_weekdays_short;
      foreach ($i18n_key_words as $kword=>$value) {
        if (!$value) continue;
        $pos = strpos($kword, ".");
        if (!($pos === false)) {
          $p = explode(".", $kword);
          $str = "";
          foreach ($p as $w) {
             $str .= "[\"".$w."\"]";
          }
          eval("\$this->keys".$str."='".$value."';");
        } else {
          $this->keys[$kword] = $value;
        }
      }
    }
  }

  // hasLang determines if a file for requested language exists.
  // This is a helper function for getBrowserLanguage below.
  function hasLang($lang)
  {
    $filename = RESOURCE_DIR . '/' . strtolower($lang) . '.lang.php';
    return file_exists($filename);
  }

  // getBrowserLanguage() returns a first supported language from browser settings.
  function getBrowserLanguage()
  {
    $acclang = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];
    if (empty($acclang)) {
      return false;
    }
    $lang_prefs = explode(',', $acclang);
    foreach ($lang_prefs as $lang_pref) {
      $lang_pref_parts = explode(';', trim($lang_pref));
      $lang = $lang_pref_parts[0];
      if ($this->hasLang($lang)) {
        return $lang; // Return full language designation (if available), such as pt-BR.
      }

      if (strlen($lang) <= 2)
        continue; // Do not bother determining main language because we already have it.

      $lang_parts = explode('-', trim($lang));
      $lang_main = $lang_parts[0];
      if ($lang_main != $lang && $this->hasLang($lang_main)) {
        return $lang_main; // Return main language designation, such as pt.
      }
    }
    return false;
  }

  // getLangFileList() returns a list of available language files.
  static function getLangFileList() {
    $fileList = array();
    $d = @opendir(RESOURCE_DIR);
    while (($file = @readdir($d))) {
      if (($file != ".") && ($file != "..")) {
        if (strpos($file, ".lang.php")) {
          $fileList[] = @basename($file);
        }
      }
    }
    @closedir($d);
    return $fileList;
  }

  // getLangFromFilename returns language designation from a file name such as (ru, pt-br, etc.).
  static function getLangFromFilename($filename)
  {
    return substr($filename, 0, strpos($filename, '.'));
  }

  // getWeekDayName returns a localized weekday name.
  function getWeekDayName($id) {
    $id = (int) $id;
    return $this->weekdayNames[$id];
  }
}
