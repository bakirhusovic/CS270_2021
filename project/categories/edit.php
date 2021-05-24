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
    <?php require('../includes/head.php') ?>
    <title>Edit category</title>

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
