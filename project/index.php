<?php
require ('includes/db.php');

$query = mysqli_query($conn, 'select * from articles order by id desc limit 5;');
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
        <?php while ($article = mysqli_fetch_assoc($query)): ?>
            <article>
                <h1><?= $article['title'] ?></h1>
                <!--<img height="200" src="/file.php?filename=<?/*= $article['image'] */?>" alt="<?/*= $article['title'] */?>">-->
                <img height="200" src="/images/<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
                <a href="article.php?id=<?= $article['id'] ?>">Read more</a>
            </article>
        <?php endwhile; ?>
    </main>
    <footer>
        &copy; CSIS270
    </footer>
</body>
</html>
