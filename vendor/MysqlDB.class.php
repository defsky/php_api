<?php
class MysqlDB
{
    private $conn;
    private $rows;
    private static $_instance; 

    private function __construct() 
	{
		global $config;
		if ($config['debug'])
		{
			print_r($config['mysql']['host']);
		}
		
        $this->conn = new mysqli($config['mysql']['host'], $config['mysql']['user'], $config['mysql']['pwd'], $config['mysql']['dbname']);
		if ($this->conn->connect_error) {
			die("connect failed: " . $this->conn->connect_error);
		}
		$this->conn->set_charset($config['mysql']['charset']);

        return $this->conn;
    }
    private function __clone(){}
	
    public static function getInstance()
	{
        if(FALSE == (self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query($sql, $connection = '') 
	{
        return $this->conn->query($sql);
    }

    public function getRow($sql, $type = MYSQL_ASSOC)
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

    public function getRows($sql, $type = MYSQL_ASSOC)
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