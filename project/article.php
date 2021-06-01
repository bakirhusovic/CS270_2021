<?php
session_start();
require ('includes/db.php');
require ('includes/function.php');
$id = $_GET['id'];
$replyId = $_GET['reply_id'] ?? null;
$replyTo = null;

if ($replyId) {
    $replyTo = mysqli_fetch_assoc(mysqli_query($conn, 'select u.first_name, u.last_name from comments c, users u where c.created_by = u.id and c.id = ' . $replyId));
}
$query = mysqli_query($conn, 'select a.*, c.name as category_name from articles a, categories c where a.category_id = c.id and a.id = ' . $id);
$commentQuery = mysqli_query($conn, 'select c.*, u.first_name, u.last_name from comments c, users u where c.created_by = u.id and article_id = ' . $id . ' order by coalesce(c.parent_id, c.id) desc, c.id');
$article = mysqli_fetch_assoc($query);
?>
<!doctype html>
<html lang="en">
<head>
    <?php require('includes/head.php') ?>
    <title>Welcome to CSIS270 Blog</title>
    <script>
        function addNewComment() {
            console.log('Test');
            //event.preventDefault();

            let data = {
                article_id: document.getElementById('article_id').value,
                content: document.getElementById('content').value,
            }

            fetch('/saveComment.php', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: JSON.stringify(data)
            })

            return false;
        }
    </script>
</head>
<body>
    <?php require('includes/header.php'); ?>
    <main class="wrapper">
        <h1><?= $article['title'] ?></h1>
        <h6><?= $article['category_name'] ?></h6>
        <img height="200" src="/images/<?= $article['image'] ?>" alt="<?= $article['title'] ?>">
        <div>
            <?= nl2br($article['content']) ?>
        </div>
        <?php if(!checkIfNotLoggedIn()): ?>
        <form action="saveComment.php" method="post" onsubmit="addNewComment()">
            <input type="hidden" id="article_id" name="article_id" value="<?= $article['id'] ?>">
            <?php if($replyTo):?>
                <input type="hidden" name="parent_id" value="<?= $replyId ?>">
                Replying to the comment id <?= $replyId ?> written by <?= $replyTo['first_name'] . ' ' . $replyTo['last_name'] ?>
            <?php endif; ?>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
        <?php endif; ?>
        <div>
            <?php while($comment = mysqli_fetch_assoc($commentQuery)): ?>
                <div class="<?= $comment['parent_id'] ? 'reply' : null ?>">
                    <p><?= nl2br($comment['content']) ?></p>
                    <span><?= $comment['first_name'] . ' ' . $comment['last_name'] ?></span>
                    <?php if(!$comment['parent_id']): ?>
                    <a href="article.php?id=<?= $article['id']?>&reply_id=<?= $comment['id']?>">Reply</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
    <footer>
        &copy; CSIS270
    </footer>
</body>
</html>
