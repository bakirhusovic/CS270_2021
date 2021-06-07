<?php
session_start();
$postPayload = file_get_contents('php://input');
$input = json_decode($postPayload, true);

if ($input) {
    require('includes/db.php');
    require('includes/function.php');

    cleanUserInput($input, $conn);

    $articleId = $input['article_id'];
    $parentId = $input['parent_id'] ?? '';
    $content = $input['content'];
    $userId = $_SESSION['user_id'];
    $currentDateTime = date('Y-m-d H:i:s');

    sleep(5);

    if ($content) {
        if ($parentId) {
            mysqli_query($conn, "insert into comments (content, article_id, created_by, created_at, parent_id) values ('{$content}', {$articleId}, {$userId}, '{$currentDateTime}', {$parentId});");
        } else {
            mysqli_query($conn, "insert into comments (content, article_id, created_by, created_at) values ('{$content}', {$articleId}, {$userId}, '{$currentDateTime}');");
        }

        $commentId = mysqli_insert_id($conn);

        $response = [
            'msg' => 'Comment is successfully saved',
            'status' => 'ok',
            'commentId' => $commentId,
            'user' => $_SESSION['first_name'] . ' ' . $_SESSION['last_name'],
        ];
    } else {
        $response = [
            'msg' => 'Comment is required',
            'status' => 'validation_failed',
        ];
    }

    header('Content-type: application/json');


    echo json_encode($response);
}
