<?php

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$age = $_POST['age'];

if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($age) && is_numeric($age) && $age >= 18) {
    echo 'Form is valid';
} else {
    echo 'Form is invalid';
}


?>
