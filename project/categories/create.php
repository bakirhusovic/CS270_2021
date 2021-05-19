<?php
session_start();
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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new category</title>
    <link rel="stylesheet" href="style.css">
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
