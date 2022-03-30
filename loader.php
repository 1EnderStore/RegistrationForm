<?php

/* ******************************** *
  *  Константы и вывод ошибок
  * ********************************* */

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define('SERVER_DIR_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('DIR_CLASSES', SERVER_DIR_ROOT . '/classes');

/* ******************************** *
  *  Подключение зависимостей
  * ********************************* */

include_once(DIR_CLASSES . '/APIHelper.php');
