<?php
session_start();

require('../includes/db.php');

$query = mysqli_query($conn, 'select * from categories ');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All categories</title>
</head>
<body>
<a href="create.php">Create new category</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $row['id']; ?>">Delete</a></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
