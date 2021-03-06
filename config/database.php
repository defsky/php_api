<?php
return [
    /**
     * 默认数据库连接
     */
    'default'   => env('DB_CONNECTION', 'mysql'),

    /**
     * 数据库连接属性配置
     */
    'connections'   => [
        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'port'      => env('DB_PORT', '3306'),
            'database'  => env('DB_DATABASE', 'world'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', 'root'),
            'charset'   => env('DB_CHARSET', 'utf8'),
            'collation' => env('DB_COLLATION', 'utf8_general_ci'),
            'prefix'    => env('DB_PREFIX', '')
        ],
        
    ]
];