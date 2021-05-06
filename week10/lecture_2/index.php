<?php

//$array = array(1, 2, 3, 4);
$array = [1, 2, 3, 4];


var_dump($array);
echo '<br>';
array_push($array, 5, 6);

$array[] = 7;

$array[] = [10, 20, 30, 40];

$array[1000] = 10;

$array[0] = -1;

var_dump($array);
echo '<br>';
var_dump(isset($array[3]));
echo '<br>';
echo $array[3];
echo '<br>';
echo 'Size of the array is: ' . count($array);
echo '<br>';
echo '<ul>';
for ($i = 0; $i < count($array); $i++) {
    if (is_array($array[$i])) {
        echo '<li>This is a nested array<ul>';
        for ($j = 0; $j < count($array[$i]); $j++) {
            echo '<li>' . $array[$i][$j] . '</li>';
        }
        echo '</ul></li>';
    } else {
        echo '<li>' . $array[$i] . '</li>';
    }
}
echo '</ul>';
echo '<ul>';
foreach($array as $item) {
    if (is_array($item)) {
        echo '<li>This is a nested array<ul>';
        foreach($item as $subItem) {
            echo '<li>' . $subItem . '</li>';
        }
        echo '</ul></li>';
    } else {
        echo '<li>' . $item . '</li>';
    }
}
echo '</ul>';
echo '<br>';
$array['first_name'] = 'John';
echo '<br>';
var_dump($array);
echo '<br>';

$assocArray = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'middle_name' => 'Middle',
    'age' => 20
];

var_dump($assocArray);
echo '<br>';
$assocArray['email'] = 'john@doe.com';

var_dump($assocArray);
echo '<br>';
echo $assocArray['first_name'];
echo '<br>';
echo $assocArray['middle_name'];
echo '<br>';

$years = range(1900, 2021);

var_dump($years);
echo '<br>';

$letters = range('aa', 'zz');

var_dump($letters);
echo '<br>';

$string = 'John, Jane';
echo $string;
echo '<br>';
$arrayFromString = explode(', ', $string);
var_dump($arrayFromString);

echo '<br>';
$array = [10, 2, 4, 1, 7, 4];
var_dump($array);;
echo '<br>';
asort($array);
var_dump($array);
echo '<br>';
ksort($array);
var_dump($array);
echo '<br>';
var_dump($array);
echo '<br>';

?>
