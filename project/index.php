<?php
session_start();
require ('includes/db.php');

$query = mysqli_query($conn, 'select * from articles order by id desc limit 6;');
?>
<!doctype html>
<html lang="en">
<head>
    <?php require('includes/head.php') ?>
    <title>Welcome to CSIS270 Blog</title>
</head>
<body>
    <?php require('includes/header.php'); ?>
    <main class="wrapper flex-main">
        <?php while ($article = mysqli_fetch_assoc($query)): ?>
            <article>
                <h2><?= $article['title'] ?></h2>
                <!--<img height="200" src="/file.php?filename=<?/*= $article['image'] */?>" alt="<?/*= $article['title'] */?>">-->
                <img src="/images/<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
                <a href="article.php?id=<?= $article['id'] ?>">Read more</a>
            </article>
        <?php endwhile; ?>
    </main>
    <footer>
        &copy; CSIS270
    </footer>
</body>
</html>
