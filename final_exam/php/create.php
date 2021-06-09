<?php
$connection = mysqli_connect('localhost', 'root', '', 'cs270_2021_project');

$affectedRows = null;

if ($_POST) {
    $name = $_POST['name'];

    mysqli_query($connection, "insert into categories (name) values ('{$name}')");

    $affectedRows = mysqli_affected_rows($connection);
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <button type="submit">Submit</button>
</form>
<?php if($affectedRows === 1): ?>
YOu have successfully inserted new category.
<?php elseif($affectedRows != null): ?>
An error has occurred.
<?php endif; ?>
</body>
</html>
