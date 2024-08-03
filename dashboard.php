<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/auth/auth_user.php';
require $documentRoot . '/layout/header.php';
require $documentRoot . '/layout/navbar.php';
?>

<div class="container">
    <p class="text-center">Welcome, <?php echo $_SESSION['user_name'] ?? ''; ?></p>
</div>