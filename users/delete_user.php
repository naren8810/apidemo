<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/auth/auth_user.php';
require  $documentRoot . '/config/config.php';

$user_data = array();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $allRows = $result->fetch_all(MYSQLI_ASSOC);
    if (!empty($allRows)) {
        $user_data = $allRows[0];
    }
}

if (isset($user_data) && !empty($user_data)) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {

        $_SESSION['success'] = "<div class='text-success mt-2 mb-2'>User deleted successfully</div>";
        logMessage("User deleted successfully", $logFile);
        header("Location:users.php");
        exit;
    } else {
        // echo "Error deleting user: " . $stmt->error;

        $_SESSION['error'] = "<div class='text-danger mt-2 mb-2'>User not deleted, $stmt->error</div>";
        logMessage("User not deleted", $logFile);
        header("Location:users.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
