<?php

class Bar
{
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}

$name = 'John';

function testFunction($a, $b, $c = null) {
    if ($c != null) {
        return $a + $b + $c;
    }

    // $d = $name; $name is not defined here

    return $a + $b;
}

$objectA = new Bar();

$objectA->setName('John');
echo $objectA->getName();

echo testFunction(2, 3, 3);
