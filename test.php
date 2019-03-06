<?php
require_once('vendor/bootstrap.php');

$a = [
    'a' => [
        'a1' => '1',
        'a2' => '2'
    ],
    'b' => '3'
];

try
{
    print_r(config('database.connections.mysql'));
}
catch (Exception $e)
{
    echo $e->getCode(). ' ' . $e->getMessage();
}