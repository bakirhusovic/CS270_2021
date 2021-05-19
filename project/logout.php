<?php
session_start();

//unset($_SESSION['auth']);

$_SESSION = array(); //$_SESSION = [];

header('Location: index.php');
