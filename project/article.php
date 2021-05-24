<?php
require ('includes/db.php');
$id = $_GET['id'];
$query = mysqli_query($conn, 'select * from articles where id = ' . $id);
$article = mysqli_fetch_assoc($query);
?>
<!doctype html>
<html lang="en">
<head>
    <?php require('includes/head.php') ?>
    <title>Welcome to CSIS270 Blog</title>
</head>
<body>
    <header>
        <h1>CSIS270 Blog</h1>
        <nav>
            <a href="index.php">Homepage</a>
            <a href="login.html">Login</a>
        </nav>
    </header>
    <main>
        <h1><?= $article['title'] ?></h1>
        <img height="200" src="/images/<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
        <div>
            <?= nl2br($article['content']) ?>
        </div>
    </main>
    <footer>
        &copy; CSIS270
    </footer>
</body>
</html>
