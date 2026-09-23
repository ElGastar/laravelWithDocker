<?php

namespace App\Services;

class Greeting
{
    public function sayHello(string $name):string
    {
        return "Hello, $name!";
    }
}