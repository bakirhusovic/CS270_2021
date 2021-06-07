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
            const comment = document.getElementById('content').value;
            const articleId = document.getElementById('article_id').value;

            let data = {
                article_id: articleId,
                content: comment,
                parent_id: document.getElementById('parent_id').value
            }

            if (comment) {
                document.getElementById('content').disabled = 'disabled';
                document.getElementById('submit-form-btn').disabled = 'disabled';
                document.getElementById('msg').innerText = 'Please wait';
                fetch('/saveCommentJson.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(function(response) {
                    return response.json()
                }).then(function(data) {
                    if (data.status === 'ok') {
                        document.getElementById('content').disabled = '';
                        document.getElementById('submit-form-btn').disabled = '';
                        document.getElementById('msg').innerText = '';
                        /*comments.push({
                            id: data.commentId,
                            content: comment,
                            user: data.user
                        })*/
                        //console.log(data.user + ' wrote ' + comment)
                        let newCommentHtml = '<div><p>' + comment + '</p><span>' + data.user + '</span><a href="article.php?id=' + articleId + '&reply_id=' + data.commentId + '">Reply</a></div>';

                        let commentsWrapper = document.getElementById('comments');

                        commentsWrapper.innerHTML = newCommentHtml + commentsWrapper.innerHTML;

                        document.getElementById('content').value = '';
                    } else {
                        alert(data.msg);
                    }
                });
            } else {
                alert('Comment is required');
            }

            return false;
        }
        function replyOnComment(commentId) {
            document.getElementById('parent_id').value = commentId;
            document.getElementById('msg').innerText = 'Reply to comment #' + commentId;
            document.getElementById('content').focus();
            window.scroll({
                top: 0,
                behavior: 'smooth',
            })
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
        <p id="msg"></p>
        <form action="saveComment.php" method="post" onsubmit="addNewComment();return false">
            <input type="hidden" id="article_id" name="article_id" value="<?= $article['id'] ?>">
            <?php /*if($replyTo):*/?><!--
                <input type="hidden" name="parent_id" value="<?/*= $replyId */?>">
                Replying to the comment id <?/*= $replyId */?> written by <?/*= $replyTo['first_name'] . ' ' . $replyTo['last_name'] */?>
            --><?php /*endif; */?>
            <input id="parent_id" type="hidden" name="parent_id" value="<?= $replyId ?>">
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <button id="submit-form-btn" type="submit">Submit</button>
        </form>
        <?php endif; ?>
        <div id="comments">
            <?php while($comment = mysqli_fetch_assoc($commentQuery)): ?>
                <div class="<?= $comment['parent_id'] ? 'reply' : null ?>">
                    <p><?= nl2br($comment['content']) ?></p>
                    <span><?= $comment['first_name'] . ' ' . $comment['last_name'] ?></span>
                    <?php if(!$comment['parent_id']): ?>
                    <a onclick="replyOnComment(<?= $comment['id']?>);return false;" href="article.php?id=<?= $article['id']?>&reply_id=<?= $comment['id']?>">Reply</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <!--<div v-for="comment in comments">
                <p>{{ comment.content }}</p>
                <span>{{ comment.user }}</span>
                <a v-if="!comment.parent_id" :href="'article.php?id=' + article.id + '&reply_id=' + comment.id">Reply</a>
            </div>-->
        </div>
    </main>
    <footer>
        &copy; CSIS270
    </footer>
</body>
</html>
