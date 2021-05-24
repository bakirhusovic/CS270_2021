<?php

function cleanUserInput(&$data, $conn)
{
    /*
     * example data
     * $data = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'courses' => ['csis270', 'csis220'],
    ];*/

    foreach ($data as $key => $value) {
        /*
         * 1st iteration
         * $key = 'first_name';
         * $value = 'John';
        */
        if (!is_array($value)) {
            $data[$key] = mysqli_real_escape_string($conn, $value);
        } else {
            cleanUserInput($value, $conn);
        }
    }
}

function checkIfNotLoggedIn() {
    return !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'];
}
