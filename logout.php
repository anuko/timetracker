<?php
/* Copyright (c) Anuko International Ltd. https://www.anuko.com
License: See license.txt */

require_once('initialize.php');
$auth->doLogout();
session_unset();

header('Location: login.php');
