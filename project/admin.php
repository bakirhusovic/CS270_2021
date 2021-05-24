<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.html');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php require('includes/head.php') ?>
    <title>Admin dashboard</title>
</head>
<body>
    <h1>Hello, <?= $_SESSION['first_name'] ?></h1>
    <a href="categories/index.php">Categories</a>
    <a href="users/index.php">Users</a>
    <a href="articles/index.php">Articles</a>
</body>
</html>
