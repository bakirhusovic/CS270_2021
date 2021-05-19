<?php

session_start();

require('includes/db.php');

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = mysqli_query($conn, "select * from users where username = '$username' and password = '$password'");

if (mysqli_num_rows($query) === 1) {
    $user = mysqli_fetch_assoc($query);
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    header('Location: admin.php');
}
