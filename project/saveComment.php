<?php
session_start();

if ($_POST) {
    require('includes/db.php');
    require('includes/function.php');

    cleanUserInput($_POST, $conn);

    $articleId = $_POST['article_id'];
    $parentId = $_POST['parent_id'] ?? '';
    $content = $_POST['content'];
    $userId = $_SESSION['user_id'];
    $currentDateTime = date('Y-m-d H:i:s');

    if ($parentId) {
        mysqli_query($conn, "insert into comments (content, article_id, created_by, created_at, parent_id) values ('{$content}', {$articleId}, {$userId}, '{$currentDateTime}', {$parentId});");
    } else {
        mysqli_query($conn, "insert into comments (content, article_id, created_by, created_at) values ('{$content}', {$articleId}, {$userId}, '{$currentDateTime}');");
    }

    header('Location: article.php?id=' . $articleId);
}
