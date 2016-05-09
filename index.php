<?php
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('BASE_PATH') or define('BASE_PATH', dirname(__FILE__).DS);

date_default_timezone_set("Europe/Kiev");

require_once(BASE_PATH.'protected'.DS.'config'.DS.'const.php');


$autoload = require_once(SYSTEM_PATH.'autoload.php');
spl_autoload_register($autoload);

$config = new Config();
App::getInstance($config)->run();
