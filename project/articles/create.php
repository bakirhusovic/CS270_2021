<?php
session_start();
require('../includes/db.php');
if ($_POST) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $publishedAt = $_POST['published_at'];
    $categoryId = $_POST['category_id'];
    $userId = $_SESSION['user_id'];

    mysqli_query($conn, "insert into articles (title, content, published_at, category_id, created_by, updated_by) values ('{$title}', '{$content}', '{$publishedAt}', {$categoryId}, $userId, $userId)");

    header('Location: index.php');
    exit();
}

$query = mysqli_query($conn, 'select * from categories');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new article</title>
</head>
<body>
<form action="" method="POST">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content"></textarea>
    </div>
    <div>
        <label for="published_at">Published at</label>
        <input type="date" name="published_at" id="published_at">
    </div>
    <div>
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id">
            <option value="">Please select a category</option>
            <?php while($row = mysqli_fetch_assoc($query)): ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit">Submit</button>
</form>
</body>
</html>
