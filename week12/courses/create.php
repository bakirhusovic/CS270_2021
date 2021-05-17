<?php
session_start();
if ($_POST) {

    require('includes/db.php');

    $name = $_POST['name'];
    $code = $_POST['code'];
    $ectsPoint = $_POST['ects_point'];

    mysqli_query($conn, "insert into courses (code, name, ects_point) values ('{$code}', '{$name}', {$ectsPoint})");
    $_SESSION['msg'] = 'New course has been added';
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
    <title>All courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="create.php">Create a new course</a>
    <form action="" method="POST">
        <div>
            <label for="name">Course Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="code">Course Code</label>
            <input type="text" name="code" id="code">
        </div>
        <div>
            <label for="ects_point">ECTS points</label>
            <input type="number" name="ects_point" id="ects_point">
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
