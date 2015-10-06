<?php
ob_start();
session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__FILE__)));
