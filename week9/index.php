<?php
$greeting = 'Hello';
$name = 'John';
$lastName = 'Doe';
$name .= ' ' . $lastName;
//$name = $name . ' ' . $lastName;
$age = 20;
$age = $age + 10;
var_dump($age);
echo strlen($name);

define('PERSON', $name);

echo str_replace('John', 'Jane', $name);

echo '<h1>' . $greeting . ' ' . $name . ' Welcome</h1>';
echo '<h1>$greeting $name Welcome</h1>';
echo "<h1>{$greeting} $name Welcome</h1>" . PERSON;

$number = 1000000;
echo number_format($number, 2, ',', '.');

echo PERSON;
?>
