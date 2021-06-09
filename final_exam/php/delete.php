<?php

$id = $_GET['id'];

$conn = mysqli_connect('localhost', 'root', '', 'cs270_2021_project');

mysqli_query($conn, 'delete from categories where id = ' . $id);

if (mysqli_affected_rows($conn) != 1) {
    echo 'An error has occurred';
} else {
    header('Location: index.php');
}
?>
