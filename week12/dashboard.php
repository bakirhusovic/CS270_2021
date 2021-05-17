<?php
session_start();

if (!isset($_SESSION['auth'])) {
    $_SESSION['msg'] = 'You need to authenticate before accessing the dashboard';
    header('Location: login.php');
    exit;
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
    <h1>Hello <?= $_SESSION['first_name'] ?></h1>
    </body>
    </html>
