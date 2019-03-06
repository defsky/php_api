<?php
namespace Core;

use \mysqli;

/**
 * MySQL封装
 * 
 * 单例类
 */
class MysqlDB
{
    private $conn;
    private $rows;
    private static $_instance; 

    private function __construct() 
	{
		$config = Config::getInstance()->get('database.connections.mysql');
		
        $this->conn = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
		if ($this->conn->connect_error) {
			die("connect failed: " . $this->conn->connect_error);
		}
		
		if (isset($config['charset'])) {
			$this->conn->set_charset($config['charset']);
		}
		
        return $this->conn;
	}
	
    private function __clone(){}
	
	/**
	 * 获取MySQL的实例
	 * 
	 */
    public static function getInstance()
	{
        if(false == (self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

	/**
	 * 执行sql查询
	 */
    public function query($sql, $connection = '') 
	{
        return $this->conn->query($sql);
    }

	/**
	 * 执行sql查询
	 * 
	 * 获取单行结果
	 */
    public function getRow($sql, $type = MYSQLI_ASSOC)
	{
        $result = $this->query($sql);
		
		if ($result->num_rows > 0) 
		{
			return $result->fetch_assoc();
		}
		else
		{
			return NULL;
		}
    }

	/**
	 * 执行sql查询
	 * 
	 * 获取多行结果
	 */
    public function getRows($sql, $type = MYSQLI_ASSOC)
	{
        $result = $this->query($sql);
		
		if ($result->num_rows > 0) 
		{
            $this->rows = [];
			while($row = $result->fetch_assoc()) 
			{
				$this->rows[] = $row;
			}
			return $this->rows;
		}
        else
		{
			return NULL;
		}
    }
}