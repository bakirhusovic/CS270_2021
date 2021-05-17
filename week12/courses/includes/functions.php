<?php

function flashMessage($key) {
    $result = '';

    if(isset($_SESSION[$key])) {
        $result = $_SESSION[$key];
        unset($_SESSION[$key]);
    }

    return $result;
}
