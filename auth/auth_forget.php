<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $user = $stmt->fetch();
    if (!empty($user)) {
        $_SESSION['forget_email'] = $email;
        $_SESSION['success'] = "<div class='text-success mt-2 mb-2'>OTP sent to email: $email</div>";
        logMessage("OTP sent to email: $email ", $logFile);
        header("Location:../forget/forget_otp.php");
        exit;
    } else {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>This email is not registered!</div>";
        logMessage("This email is not registered! ", $logFile);
        header("Location:../forget/forget.php");
        exit;
    }
}
