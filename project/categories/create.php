<?php
session_start();
require ('../includes/function.php');

if (checkIfNotLoggedIn()) {
    header('Location: ../login.html');
    exit();
}
if ($_POST) {

    require('../includes/db.php');

    $name = $_POST['name'];

    mysqli_query($conn, "insert into categories (name) values ('{$name}')");

    header('Location: index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php require('../includes/head.php') ?>
    <title>Add new category</title>
</head>
<body>
<form action="" method="POST">
    <div>
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name">
    </div>
    <button type="submit">Submit</button>
</form>
</body>
</html>
