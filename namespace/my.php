<?php
namespace com\getinstance\util;

require_once 'global.php';
class Lister
{
    public static function helloworld()
    {
        print("hello from ".__NAMESPACE__."\n");
    }
}
Lister::helloworld();
\Lister::helloworld();
class Debug
{
    public static function helloworld()
    {
        print("hello from Debug\n");
    }
}

namespace main;

class Debug
{
    public static function helloworld()
    {
        print("hello from main\Debug\n");
    }
}
// uDebug::helloworld();

