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

// Class ttConfigHelper is a helper class to handle comma-separated lists of config data.
// For example, in tt_groups table we have a field called "config", that may store something like:
//
// allow_overlap,uncompleted_indicators,minutes_in_unit:15,future_entries
//   Above, some values are simply defined by their presence such as allow_overlap.
//   Other values have associated values after colon such as minutes_in_work_unit (15).
class ttConfigHelper {
  var $config = null; // Source config string.
  var $config_array = null;  // Array of config values.

  // Constructor.
  function __construct($config) {
    $this->config = trim($config, ' ,');
    if ($this->config)
      $this->config_array = explode(',', $this->config);
  }

  // getDefinedValue determines if a value identified by name is defined.
  function getDefinedValue($name) {
    $defined = $this->config_array ? in_array($name, $this->config_array) : false;
    return $defined;
  }

  // setDefinedValue either sets or deletes a defined value identified by name.
  function setDefinedValue($name, $set = true) {
    if ($set) {
      // Setting part.
      if (!$this->getDefinedValue($name)) {
        $this->config_array[] = $name;
        $this->config = implode(',', $this->config_array);
        return;
      }
    } else {
      // Deleting part.
      if ($this->config_array) {
        foreach ($this->config_array as $key => $value) {
          if ($value === $name) {
            unset($this->config_array[$key]);
            $this->config = implode(',', $this->config_array);
            return;
          }
        }
      }
    }
  }

  // The getIntValue parses an integer value from the source config array.
  function getIntValue($name, $defaultVal = 0) {
    $name_with_colon = $name.':';
    $len = strlen($name_with_colon);

    if ($this->config_array) {
      foreach ($this->config_array as $unparsed_value) {
        if (substr($unparsed_value, 0, $len) === $name_with_colon) {
          // Found value.
          $unparsed_len = strlen($unparsed_value);
          $int_value = (int) substr($unparsed_value, -($unparsed_len - $len));
          return $int_value;
        }
      }
    }
    return $defaultVal;
  }

  // The setIntValue sets an integer value into config array.
  function setIntValue($name, $value) {
    // Try to find and replace an already existing value.
    $name_with_colon = $name.':';
    $len = strlen($name_with_colon);

    if ($this->config_array) {
      foreach ($this->config_array as $key => $unparsed_value) {
        if (substr($unparsed_value, 0, $len) === $name_with_colon) {
          // Found an already existing value.
          if ($value !== null) {
            // Replace value.
            $this->config_array[$key] = $name.':'.$value;
          } else {
            // Remove value if our new value is NULL.
            unset($this->config_array[$key]);
          }
          $this->config = implode(',', $this->config_array);
          return;
        }
      }
    }
    // If we get here, the value was not found, so add it.
    $this->config_array[] = $name.':'.$value;
    $this->config = implode(',', $this->config_array);
    return;
  }

  // The getConfig returns the config string.
  function getConfig() {
    return trim($this->config, ' ,');
  }
}
