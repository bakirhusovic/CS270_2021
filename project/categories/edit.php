<?php

$id = $_GET['id'];

if (!$id) {
    die('ID parameter is missing');
}

require('../includes/db.php');

$query = mysqli_query($conn, 'select * from categories where id = '. $id);
if (mysqli_num_rows($query) === 0) {
    die('Category not found');
}
$row = mysqli_fetch_assoc($query);

if ($_POST) {

    $id = $_POST['id'];
    $name = $_POST['name'];

    mysqli_query($conn, "update categories set name = '{$name}' where id = {$id}");

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
    <title>Edit category</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div>
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" value="<?= $row['name'] ?>">
    </div>
    <button type="submit">Submit</button>
</form>
</body>
</html>
