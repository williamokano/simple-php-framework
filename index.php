<?php
define("ROOTDIR", dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR);
require_once "app/config.php";
require_once "app/autoloader.php";
require_once "app/routes.php";

use App\Application;

$app = new Application;
$app->run();
