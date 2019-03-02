<?php

if (!defined('ROOTDIR')) {
    define('ROOTDIR', realpath(__DIR__ . '/../'));
}

class Autoloader {
    public static function my_class_loader($name) {
        $fname = ROOTDIR . '/class/' . $name . '.class.php';
        if (file_exists($fname)) {
            require_once($fname);
            if (class_exists($name, false)) {
                return true;
            } else {
                throw new Exception('class define not found : '.$fname, -98);
            }
        } else {
            throw new Exception('class file not found : '.$fname, -99);
        }

        return false;
    }
}

spl_autoload_register('Autoloader::my_class_loader');
