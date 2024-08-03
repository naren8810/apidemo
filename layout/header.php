<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

$page_title = '';
$active_nav_home = '';
$active_nav_users = '';
$active_nav_profile = '';
$active_nav_login = '';
$active_nav_register = '';
$active_nav_forget = '';
if (isset($segments[2]) && !empty($segments[2])) {
    if ($segments[2] == 'users.php' || $segments[2] == 'edituser.php') {
        $active_nav_users = 'active';
        $page_title = 'Users';
    } else if ($segments[2] == 'profile.php') {
        $active_nav_profile = 'active';
        $page_title = 'Profile';
    } else if ($segments[2] == 'login.php') {
        $active_nav_login = 'active';
        $page_title = 'Login';
    } else if ($segments[2] == 'register.php') {
        $active_nav_register = 'active';
        $page_title = 'Register';
    } else if ($segments[2] == 'forget.php') {
        $active_nav_forget = 'active';
        $page_title = 'Forget Password';
    } else {
        $active_nav_home = 'active';
        $page_title = 'Dashboard';
    }
} elseif (isset($segments[1]) && !empty($segments[1])) {
    if ($segments[1] == 'users.php' || $segments[1] == 'edituser.php') {
        $active_nav_users = 'active';
        $page_title = 'Users';
    } else if ($segments[1] == 'profile.php') {
        $active_nav_profile = 'active';
        $page_title = 'Profile';
    } else if ($segments[1] == 'login.php') {
        $active_nav_login = 'active';
        $page_title = 'Login';
    } else if ($segments[1] == 'register.php') {
        $active_nav_register = 'active';
        $page_title = 'Register';
    } else if ($segments[1] == 'forget.php') {
        $active_nav_forget = 'active';
        $page_title = 'Forget Password';
    } else {
        $active_nav_home = 'active';
        $page_title = 'Dashboard';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $page_title; ?>">
    <meta name="keywords" content="<?php echo $page_title; ?>">
    <meta name="author" content="<?php echo $page_title; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invalid-feedback {
            display: none;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }

        #navbarNav {
            margin-left: 75% !important;
        }
    </style>
</head>

<body>