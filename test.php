<?php
/**
 * 第一步 引入框架启动代码
 */
require_once('vendor/bootstrap.php');

/**
 * 第二步 根据需要导入类
 */
use Core\MysqlDB;

/**
 * 第三步 注册请求处理函数
 */
Request()->handle('GET', function ($data) {
    print_r(config('database.connections.mysql'));
    echo '<br>';
    print_r(config('app.name'));
    echo '<br>';
    print_r(MysqlDB::getInstance()->getRows('select * from realmlist'));
    echo '<br>';
    
    print_r($data);
});

Request()->handle('POST', function ($data) {
    echo 'you post page<br>';
    print_r($data);
});

/**
 * 第四步 处理请求
 */
Request()->process();