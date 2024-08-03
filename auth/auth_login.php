<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $datetime = date('Y-m-d H:i:s');

    // Basic backend validation
    if (empty($email) || empty($password)) {
        echo "All fields are required";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email or password</div>";
        header("Location:../login.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email or password</div>";
        header("Location:../login.php");
        exit;
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        //code...
        $stmt = $conn->prepare("SELECT id,name,email,password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows <= 0) {

            $_SESSION['user_id'] = '';
            $_SESSION['user_loggedin'] = FALSE;

            $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email or password</div>";
            logMessage("Error in logging in: Invalid email or password", $logFile);
            header("Location:../login.php");
            exit;
        }

        $stmt->bind_result($id, $name, $email, $hashedPassword);
        $user = $stmt->fetch();

        if (password_verify($password, $hashedPassword) == 1) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_id'] = $id;
            $_SESSION['user_loggedin'] = TRUE;
            $_SESSION['super_admin'] = FALSE;
            if ($email == 'admin@gmail.com') {
                $_SESSION['super_admin'] = TRUE;
                header("Location: ../users/users.php");
                exit;
            } else {
                header("Location: ../dashboard.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Invalid email or password</div>";
            logMessage("Error in logging in: Invalid email or password", $logFile);
            header("Location:../login.php");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>Error in logging in: ," . $e->getMessage() . "</div>";
        logMessage("Error in logging in: ", $e->getMessage(), $logFile);
        header("Location:../login.php");
        exit;
    }


    logMessage("user email($email) logged in successfully", $logFile);
    echo "user email($email) logged in successfully";
    $stmt->close();
    $conn->close();
}
