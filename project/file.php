<?php

$filename = $_GET['filename'];

$file = file_get_contents('images/' . $filename);

if (true) {
    header('Content-type: image/jpeg');

    echo $file;
} else {
    echo 'Not authorized';
}
