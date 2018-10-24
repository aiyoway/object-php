<?php
class Person
{
    private $write;
    private $_name;
    private $_age;
    public function __construct(PersonWriter $write)
    {
        $this->write = $write;
    }
    public function __call($method, $args)
    {
        if (method_exists($this->write, $method)) {
            $this->write->$method($this);
        }
    }
    public function __get($property)
    {
        echo "get...\n";
        $method = "get{$property}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }
    public function __set($property, $val)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            return $this->$method($val);
        }
    }
    public function __isset($property)
    {
        echo "isset...\n";
        $method = "get{$property}";
        return method_exists($this, $method);
    }
    public function __unset($property)
    {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            $this->$method(null);
        }
    }
    public function getName()
    {
        return $this->_name;
    }
    public function setName($name)
    {
        $this->_name = $name;
        if (!is_null($this->_name)) {
            $this->_name = strtoupper($this->_name);
        }
    }
    public function getAge()
    {
        return $this->_age;
    }
    public function setAge($age)
    {
        $this->_age = strtoupper($age);
    }
}

// $p = new Person();
// if (isset($p->name)) {
// print($p->name);
// }
// $p->name = 'tom';

class PersonWriter
{
    public function writeName(Person $p)
    {
        print("{$p->getName()}\n");
    }
    public function writeAge(Person $p)
    {
        print("{$p->getAge()}\n");
    }
}

$person = new Person(new PersonWriter);
$person->name='lee';
$person->writeName();
