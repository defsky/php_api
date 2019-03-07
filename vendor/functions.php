<?php
use Core\Config;
use Core\Http\Request;

/**
 * 获取env配置
 */
function env($key, $default)
{
    $value = Config::getInstance()->getEnv($key);

    if (! $value) {
        return $default;
    }
    
    return $value;
}

/**
 * 获取config配置
 */
function config($key)
{
    return Config::getInstance()->get($key);
}


function Request()
{
    return Request::instance();
}