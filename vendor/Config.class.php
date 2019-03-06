<?php
namespace Core;

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! defined('ROOTDIR')) {
    define('ROOTDIR', realpath(__DIR__ . DS . '../'));
}

/**
 * 配置文件管理类
 */
class Config
{
    /**
     * 配置文件后缀名
     */
    private const CONFIG_FILE_SUFFIX = '.php';

    /**
     * 配置文件目录
     */
    private const CONFIG_DIR = ROOTDIR . DS . 'config';

    /**
     * .env配置文件路径
     */
    private const DOT_ENV_PATH = ROOTDIR.DS.'.env';

    /**
     * .env配置表
     */
    private $env_map;

    /**
     * 类实例
     */
    private static $instance;

    /**
     * 私有构造函数, 防止从外部实例化
     */
    private function __construct()
    {
        $this->env_map = [];

        $lines = file(self::DOT_ENV_PATH);

        foreach ($lines as $line) {
            $config_item = explode('=', $line);

            if (count($config_item) > 2) {
                throw new \Exception('.env syntax error', -96);
            }

            $config_key = trim($config_item[0]);
            $config_value = '';

            if (count($config_item) == 2) {
                $config_value = trim($config_item[1]);
            }

            if (array_key_exists($config_key, $this->env_map)) {
                throw new \Exception('dumplicate key in .env', -95);
            }
            $this->env_map[$config_key] = $config_value;
        }
    }

    /**
     * 重写clone函数，防止对象克隆
     */
    private function __clone()
    {

    }

    /**
     * 获取类的单实例
     */
    public static function getInstance()
    {
        if (false == (self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取指定配置文件的配置项
     */
    public function get ($config_key)
    {
        $keys = explode('.', $config_key);

        $file_name = array_shift($keys) . self::CONFIG_FILE_SUFFIX;
        $file_path = self::CONFIG_DIR . DS . $file_name;

        if (file_exists($file_path) && is_file($file_path)) {
            $configs = include($file_path);

            $target = $configs;
            foreach ($keys as $key) {
                if (array_key_exists($key, $target)) {
                    $target = $target[$key];
                } else {
                    throw new \Exception('config \'' . $config_key . '\' not found', -97);
                }
            }

            return $target;
        }
        
        throw new \Exception('config file \''. $file_name .'\' not found', -98);
    }

    /**
     * 获取 .env 配置
     */
    public function getEnv ($key)
    {
        if (array_key_exists($key, $this->env_map)) {
            return $this->env_map[$key];
        }

        return false;
    }

}