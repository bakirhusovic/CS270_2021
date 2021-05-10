<?php
$conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

$query = mysqli_query($conn, 'select * from courses limit 3, 30');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="create.php">Create a new course</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Code</th>
            <th>Points</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['code']; ?></td>
            <td><?= $row['ects_point']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
