<?php
require_once('vendor/bootstrap.php');

use Core\MysqlDB;

try
{
    print_r(config('database.connections.mysql'));
    echo '<br>';
    print_r(config('app.name'));
    echo '<br>';
    print_r(MysqlDB::getInstance()->getRows('select * from realmlist'));
}
catch (Exception $e)
{
    echo $e->getCode(). ' ' . $e->getMessage();
}