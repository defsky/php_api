<?php
namespace Core\Http;

class Context
{
    private static $instance;

    private function __construct ()
    {
        $this->request = Request::instance();
    }

    public static function instance () : Context
    {
        if (false == (self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}