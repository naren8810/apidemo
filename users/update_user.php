<?php
require 'config.php';

$_SESSION['error'] = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $_SESSION['input_id'] = $id;
    $_SESSION['input_name'] = $name;
    $_SESSION['input_email'] = $email;

    $datetime = date('Y-m-d H:i:s');

    // Basic backend validation
    if (empty($name) || empty($email)) {
        echo "All fields are required";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>All fields are required</div>";
        logMessage("Error in logging in: All fields are required", $logFile);
        header("Location:users.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email format</div>";
        logMessage("Error in logging in: Invalid email format", $logFile);
        header("Location:users.php");
        exit;
    }

    try {
        //code...
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param('ssi', $name, $email, $id);
        if ($stmt->execute()) {
            echo "User data updated successfully";
            $_SESSION['success'] = "<div class='text-success mt-2 mb-2'>User data updated successfully</div>";
            logMessage("User data updated successfully", $logFile);
            header("Location:users.php");
            exit;
        } else {
            $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Error in updating: " . $e->getMessage() . " </div>";
            logMessage("Error in updating: ", $e->getMessage(), $logFile);
            header("Location:users.php");
            exit;
        }
    } catch (Exception $e) {
        //throw $th;
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Error in updating: " . $e->getMessage() . " </div>";
        logMessage("Error in updating: ", $e->getMessage(), $logFile);
        header("Location:users.php");
        exit;
    }

    $_SESSION['input_name'] = '';
    $_SESSION['input_email'] = '';
    $_SESSION['input_password'] = '';
    $stmt->close();
    $conn->close();
}

header("Location:users.php");
