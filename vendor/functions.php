<?php
use Core\Config;

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