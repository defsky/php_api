<?php
if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! defined('ROOTDIR')) {
    define('ROOTDIR', realpath(__DIR__ . DS . '../'));
}

require_once('Autoloader.class.php');

spl_autoload_register('Core\Autoloader::classLoader');

include_once('functions.php');

Request();