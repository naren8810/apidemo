<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

$_SESSION['error'] = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $_SESSION['input_name'] = $name;
    $_SESSION['input_email'] = $email;
    $_SESSION['input_password'] = $password;
    $datetime = date('Y-m-d H:i:s');

    // Basic backend validation
    if (empty($name) || empty($email) || empty($password)) {
        echo "All fields are required";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>All fields are required</div>";
        logMessage("Error in logging in: All fields are required", $logFile);
        header("Location:../register.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email format</div>";
        logMessage("Error in logging in: Invalid email format", $logFile);
        header("Location:../register.php");
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // SQL to create table
    /*$sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        // echo "Table users created successfully or already exists.";
        logMessage("Table users created successfully or already exists.", $logFile);
    } else {
        // echo "Error creating table: " . $conn->error;
        logMessage("Error creating table: " . $conn->error, $logFile);
    }*/

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $user = $stmt->fetch();
    if (!empty($user)) {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>This email is already registered, try new email!</div>";
        logMessage("This email is already registered, try new email! ", $logFile);
        header("Location:../register.php");
        exit;
    }


    try {
        //code...
        $stmt = $conn->prepare("INSERT INTO `users`(name, email, password,created_at) VALUES(?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $email, $passwordHash, $datetime);

        $stmt->execute();
    } catch (Exception $e) {
        //throw $th;
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Error in registration: " . $e->getMessage() . " </div>";
        logMessage("Error in registration: ", $e->getMessage(), $logFile);
        header("Location:../register.php");
        exit;
    }


    logMessage("New user name($name) registered successfully", $logFile);
    echo "New user name($name) registered successfully";
    
    $_SESSION['input_name'] = '';
    $_SESSION['input_email'] = '';
    $_SESSION['input_password'] = '';
    $stmt->close();
    $conn->close();
}

header("Location:../login.php");
