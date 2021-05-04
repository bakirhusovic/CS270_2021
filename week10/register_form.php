<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

if ($_POST) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
        echo '<p class="success">Form is valid</p>';
    } else {
        echo '<p class="error">Form is invalid</p>';
    }
}

?>
<form action="register_form.php" method="post">
    <div>
        <label for="first_name">First name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $_POST['first_name'] ?? '' ?>">
    </div>
    <div>
        <label for="last_name">Last name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $_POST['last_name'] ?? '' ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Register</button>
</form>
</body>
</html>
