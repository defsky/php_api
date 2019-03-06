<?php
namespace App\Mir;

class Realm
{
    public function __construct ($name)
    {
        $this->name = $name;
    }

    public function status ()
    {
        return 'Realm name : ' . $this->name;
    }
}