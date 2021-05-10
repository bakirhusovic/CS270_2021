<?php
// serverTimezone UTC - PHPStorm connection setting
$conn = mysqli_connect('localhost', 'root', '', 'cs270_2021');

if (!$conn) {
    exit('Error connecting to the DB server');
} else {
    echo 'Successfully connected to the DB server';
}

$query = mysqli_query($conn, 'select code, name, id from courses');

echo 'We have ' . mysqli_num_rows($query) . ' courses in the database';

while ($row = mysqli_fetch_assoc($query)) {
    echo 'ID is ' . $row['id'];
}

mysqli_query($conn, "insert into courses (code, name, ects_point) values ('CSTEST2', 'TEST', 1)");
echo mysqli_affected_rows($conn);
?>
Hello world
