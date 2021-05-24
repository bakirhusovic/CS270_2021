<?php
session_start();
require ('../includes/function.php');

if (checkIfNotLoggedIn()) {
    header('Location: ../login.html');
    exit();
}

$id = $_GET['id'];

if (!$id) {
    die('ID parameter is missing');
}

require('../includes/db.php');

$query = mysqli_query($conn, 'delete from articles where id = ' . $id);

if (mysqli_affected_rows($conn) === 1) {
    header('Location: index.php');
}
