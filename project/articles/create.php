<?php
session_start();
require ('../includes/function.php');

if (checkIfNotLoggedIn()) {
    header('Location: ../login.html');
    exit();
}

require('../includes/db.php');
if ($_POST) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $publishedAt = $_POST['published_at'];
    $categoryId = $_POST['category_id'];
    $userId = $_SESSION['user_id'];
    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']) {
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
    }

    mysqli_query($conn, "insert into articles (image, title, content, published_at, category_id, created_by, updated_by) values ('{$imageName}', '{$title}', '{$content}', '{$publishedAt}', {$categoryId}, $userId, $userId)");

    header('Location: index.php');
    exit();
}

$query = mysqli_query($conn, 'select * from categories');

?>
<!doctype html>
<html lang="en">
<head>
    <?php require('../includes/head.php') ?>
    <title>Add new article</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" id="image">
    </div>
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
