<?php
class StaticExample
{
    public static $aNum = 0;
    public static function sayHello()
    {
        self::$aNum++;
        print("hello (" . self::$aNum . " )\n");
    }
}

// print(StaticExample::$aNum);
// StaticExample::sayHello();

