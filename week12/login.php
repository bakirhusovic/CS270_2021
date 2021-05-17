<?php
session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['msg'] = 'You are already logged in';
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "select * from users where username = '{$username}' and password = '{$password}'");

    if (mysqli_num_rows($query) == 1 ) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['auth'] = true;
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        header('Location: index.php');
        exit(); //exit;
    } else {
        $msg = 'Wrong username and/or password';
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
<?= $msg ?? '' ?>
<?php if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
<form action="" method="POST">
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>
    <button type="submit">Submit</button>
</form>
</body>
</html>
