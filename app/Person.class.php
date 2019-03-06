<?php
namespace App;

class Person
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function hello()
    {
        return 'How are you! I am '.$this->name.'.';
        
    }
}
