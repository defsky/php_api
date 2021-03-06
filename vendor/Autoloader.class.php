<?php
namespace Core;

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! defined('ROOTDIR')) {
    define('ROOTDIR', realpath(__DIR__ . DS . '../'));
}

/**
 * 自动加载器类
 */
class Autoloader
{
    /**
     * 类定义文件的后缀名
     */
    private static $class_file_suffix = '.class.php';

    /**
     * 根名称空间路径映射表
     */
    private static $vendor_map = [
        'App' => 'app',
        'Core' => 'vendor',
    ];

    /**
     * 类加载器
     */
    public static function classLoader ($classname)
    {
        $file_path = self::parseFilePath($classname);

        if (file_exists($file_path) && is_file($file_path)) {
            include_once($file_path);

            if (class_exists($classname, false)) {
                return true;
            }
        }
        
        //throw new \Exception('class '. $classname .' undefined', -99);
        return false;
    }

    /**
     * 根据类的完全限定名解析类定义文件的路径
     */
    private static function parseFilePath($classname)
    {
        $vendor = explode('\\', $classname)[0];
        
        if (! array_key_exists($vendor, self::$vendor_map)) {
            //throw new \Exception('undefined namespace \'' . $vendor . '\'', -94);
            return ;
        }

        $vendor_path = ROOTDIR . DS . self::$vendor_map[$vendor];
        $relative_path = substr($classname, strlen($vendor)) . self::$class_file_suffix;
        $file_path = strtr($vendor_path . DS . $relative_path, '\\', DS);
        
        return $file_path;
    }
}
