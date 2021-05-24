<?php
session_start();
require ('../includes/function.php');

if (checkIfNotLoggedIn()) {
    header('Location: ../login.html');
    exit();
}

require('../includes/db.php');

$query = mysqli_query($conn, 'select a.*, c.name as category_name from articles a, categories c where a.category_id = c.id ');

?>
<!doctype html>
<html lang="en">
<head>
    <?php require('../includes/head.php') ?>
    <title>All articles</title>
</head>
<body>
<a href="create.php">Create new article</a>
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><img src="../images/<?= $row['image']; ?>" alt="<?= $row['title']; ?>" height="80"></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['category_name']; ?></td>
            <td><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $row['id']; ?>">Delete</a></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
