<?php

if ($_POST) {
    $conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "select * from users where username = '{$username}' and password = '{$password}'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo 'Hello ' . $row['username'];

        exit();
    } else {
        echo 'Wrong username and/or password';
    }
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
<form action="" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= $_POST['username'] ?? '' ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Login</button>
</form>
</body>
</html>
