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

class ttHttpRequest {
  // The getMethod function returns the type of request (GET, POST, etc.).
  function getMethod() {
    return isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : false;
  }

  // The isGet function determines if a request method is a GET.
  function isGet() {
    return ($this->getMethod() == 'GET');
  }

  // The isPost function determines if a request method is a POST.
  function isPost() {
    return ($this->getMethod() == 'POST');
  }

  // The getParameter is the primary function of this class. It returns request parameter
  // identified by $name.
  function getParameter($name = '', $default = null) {
    switch ($this->getMethod())
    {
      case 'GET':
        if (isset($_GET[$name]) && ($_GET[$name] != ''))
          return $_GET[$name];

      case 'POST':
        if (isset($_POST[$name]) && ($_POST[$name] != ''))
          return  $_POST[$name];
    }
    return $default;
  }
}
