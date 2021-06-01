<?php

$test = [
    'firstName' => 'Jane',
    'lastName' => 'Doe',
];
//default content type text/html
header('Content-type: application/json');

echo json_encode($test);
