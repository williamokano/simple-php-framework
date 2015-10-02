<?php
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(realpath(__FILE__)));
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR . "controllers");
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(realpath(__FILE__)) . DIRECTORY_SEPARATOR . "lib");

spl_autoload_register(function ($class) {

    $includePath = explode(PATH_SEPARATOR, get_include_path());
    $file = str_replace("/", "\\", $class) . ".php";

    foreach ($includePath as $path) {
        $fullFilePath = $path . "\\" . $file;
        if (file_exists($fullFilePath)) {
            require_once $file;
            return true;
        }
    }
    return false;
});
