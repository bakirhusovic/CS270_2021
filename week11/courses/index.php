<?php
$conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

$queryString = 'select * from courses ';

$perPage = 15;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $perPage;

$sort = $_GET['sort'];
$sortDirection = $_GET['sort_dir'] ?? 'asc';

if ($sort) {
    $queryString .= 'order by ' . $sort . ' ' . $sortDirection;
}

$query = mysqli_query($conn, $queryString . ' limit ' . $offset . ', ' . $perPage);

$numOfCourses = mysqli_fetch_assoc(mysqli_query($conn, 'select count(1) as num_of_courses from courses'));

$numOfPages = ceil($numOfCourses['num_of_courses'] / $perPage);

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
            <th>
                <?php if($sort === 'name' && $sortDirection === 'desc'): ?>
                <a href="index.php?sort=name">Name</a>
                <?php else: ?>
                    <a href="index.php?sort=name&sort_dir=desc">Name</a>
                <?php endif;?>
            </th>
            <th>Code</th>
            <th><a href="index.php?sort=ects_point">Points</a></th>
            <th>Edit</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['code']; ?></td>
            <td><?= $row['ects_point']; ?></td>
            <td><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php for($i = 0; $i < $numOfPages; $i++): ?>
        <a href="index.php?page=<?= $i + 1 ?><?= $sort ? '&sort=' . $sort : '' ?><?= $sortDirection ? '&sort_dir=' . $sortDirection : '' ?>"><?= $i + 1 ?></a>
    <?php endfor; ?>
</body>
</html>
