<?php
include_once('../vendor/autoload.php');

$cname = $_GET['cname'];
$name = $_GET['name'];

try
{
    $p1 = new $cname($name);
    
    echo $p1->hello();
}
catch (Exception $e)
{
    echo $e->getCode().':'.$e->getMessage();
}
