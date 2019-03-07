<?php
namespace Core\Http;

/**
 * HTTP 请求类
 */
class Request
{
    protected static $handlers;
    protected static $instance;

    protected $method;
    protected $data;

    private function __construct ()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->handleData($this->method);
    }

    /**
     * 获取请求实例
     */
    public static function instance () : Request
    {
        if (false == (self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 绑定请求处理函数
     */
    public static function handle ($requeset_method, $handler)
    {
        static::$handlers[$requeset_method] = $handler;
    }

    /**
     * 处理请求数据
     */
    private function handleData ($method)
    {
        switch ($method) {
            case 'GET':
                $this->data = $_GET;
                break;
            case 'POST':
                if (count($_POST) > 0) {
                    $this->data = $_POST;
                } else {
                    $data = json_decode( file_get_contents('php://input'), true);
                    $this->data = $data ? $data : [];
                }
                break;
            default:
                
        }
    }

    public function process()
    {
        static::$handlers[$this->method]($this->data);
    }
}