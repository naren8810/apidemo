<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the full URI
$uri = $_SERVER['REQUEST_URI'];

// Remove the query string if it exists
$uri = strtok($uri, '?');

// Split the URI into segments
$segments = explode('/', trim($uri, '/'));

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && isset($_SESSION['user_loggedin']) && !empty($_SESSION['user_loggedin'])) {
    // header("Location:dashboard.php");

    if (isset($segments[1]) && !empty($segments[1])) {
        if ($segments[1] == 'login.php') {

            header("Location:../dashboard.php");
        } else {
        }
        if ($segments[1] == 'users.php') {

            if (isset($_SESSION['super_admin']) && !empty($_SESSION['super_admin'])) {
            } else {

                header("Location:../dashboard.php");
            }
        }
    } else {
        header("Location:../dashboard.php");
    }
} else {
    if (isset($segments[1]) && !empty($segments[1])) {
        if ($segments[1] == 'login.php') {
        } else {
            header("Location:../login.php");
        }
    } else {

        header("Location:../login.php");
    }
}
