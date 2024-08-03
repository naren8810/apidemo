<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['forget_email']);
    $otp = trim($_POST['otp']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $_SESSION['input_otp'] = $otp;
    $_SESSION['input_new_password'] = $new_password;
    $_SESSION['input_confirm_password'] = $confirm_password;

    if ($otp != '1111') {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid OTP! </div>";
        logMessage("Invlaid OTP!", $logFile);
        header("Location:../forget/forget_otp.php");
        exit;
    }
    if ($new_password != $confirm_password) {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Password & Confirm password does not match! </div>";
        logMessage("Password & Confirm password does not match!", $logFile);
        header("Location:../forget/forget_otp.php");
        exit;
    }
    $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $user = $stmt->fetch();
    if (!empty($user)) {

        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param('ss', $passwordHash, $email);
        if ($stmt->execute()) {

            $_SESSION['input_otp'] = '';
            $_SESSION['input_new_password'] = '';
            $_SESSION['input_confirm_password'] = '';

            $_SESSION['success'] = "<div class='text-success mt-2 mb-2'>User password changed successfully</div>";
            logMessage("User password changed successfully", $logFile);
            header("Location:../forget/forget_done.php");
            exit;
        } else {
            $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Error in updating password: " . $e->getMessage() . " </div>";
            logMessage("Error in updating password: ", $e->getMessage(), $logFile);
            header("Location:../forget/forget_done.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>This email is not registered!</div>";
        logMessage("This email is not registered! ", $logFile);
        header("Location:../forget/forget.php");
        exit;
    }
}
