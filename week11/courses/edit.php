<?php

$id = $_GET['id'];

if (!$id) {
    die('ID parameter is missing');
}

$conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

$query = mysqli_query($conn, 'select * from courses where id = '. $id);
if (mysqli_num_rows($query) === 0) {
    die('Course not found');
}
$row = mysqli_fetch_assoc($query);

if ($_POST) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $ectsPoint = $_POST['ects_point'];

    mysqli_query($conn, "update courses set code = '{$code}', name = '{$name}', ects_point = {$ectsPoint} where id = {$id}");

    echo mysqli_affected_rows($conn);
    die();

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
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div>
            <label for="name">Course Name</label>
            <input type="text" name="name" id="name" value="<?= $row['name'] ?>">
        </div>
        <div>
            <label for="code">Course Code</label>
            <input type="text" name="code" id="code" value="<?= $row['code'] ?>">
        </div>
        <div>
            <label for="ects_point">ECTS points</label>
            <input type="number" name="ects_point" id="ects_point" value="<?= $row['ects_point'] ?>">
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
