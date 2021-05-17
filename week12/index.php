<?php
session_start();
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

<?php if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
} ?>
    Hello, <?= $_SESSION['first_name'] ?? ''; ?>
    <h1>HOME</h1>
    <?php if (!isset($_SESSION['auth'])): ?>
        <a href="login.php">Login</a>
    <?php else: ?>
        Hello, <?= $_SESSION['first_name']; ?>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
</body>
</html>
