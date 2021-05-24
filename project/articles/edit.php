<?php
session_start();
require ('../includes/function.php');

if (checkIfNotLoggedIn()) {
    header('Location: ../login.html');
    exit();
}

$id = $_GET['id'];

if (!$id) {
    die('ID parameter is missing');
}

require('../includes/db.php');

$query = mysqli_query($conn, 'select * from articles where id = '. $id);
if (mysqli_num_rows($query) === 0) {
    die('Category not found');
}
$row = mysqli_fetch_assoc($query);


$categoryQuery = mysqli_query($conn, 'select * from categories');

if ($_POST) {
    cleanUserInput($_POST, $conn);

    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publishedAt = $_POST['published_at'];
    $categoryId = $_POST['category_id'];
    $userId = $_SESSION['user_id'];

    $result = mysqli_query($conn, "update articles set title = '{$title}', content = '{$content}', category_id = {$categoryId}, updated_by = '{$userId}' where id = {$id}");

    header('Location: index.php');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php require('../includes/head.php') ?>
    <title>Edit category</title>

</head>
<body>
<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $row['title'] ?>">
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content"><?= $row['content'] ?></textarea>
    </div>
    <div>
        <label for="published_at">Published at</label>
        <input type="date" name="published_at" id="published_at" value="<?= $row['published_at'] ?>">
    </div>
    <div>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            <option value="">Please select a category</option>
            <?php while($categoryRow = mysqli_fetch_assoc($categoryQuery)): ?>
                <option value="<?= $categoryRow['id'] ?>" <?= $categoryRow['id'] == $row['category_id'] ? 'selected' : null; ?>><?= $categoryRow['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <button type="submit">Submit</button>
</form>
</body>
</html>
