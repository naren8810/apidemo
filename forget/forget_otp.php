<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/layout/header.php';

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

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Reset Password</h3>
                    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        $_SESSION['success'] = '';
                    } ?>
                </div>
                <div class="card-body">
                    <form id="forget_otpForm" novalidate method="POST" action="../auth/auth_forget_otp.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="otp">Enter OTP</label>
                            <input type="otp" name="otp" class="form-control" id="otp" value="<?php echo $_SESSION['input_otp'] ?? ''; ?>" placeholder="Enter otp" required>
                            <div class="invalid-feedback">
                                Please enter a valid otp.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password" value="<?php echo $_SESSION['input_new_password'] ?? ''; ?>" required minlength="6">
                            <div class="invalid-feedback">
                                Password must be at least 6 characters long.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Password" value="<?php echo $_SESSION['input_confirm_password'] ?? ''; ?>" required minlength="6">
                            <div class="invalid-feedback">
                                Password must be at least 6 characters long.
                            </div>
                        </div>
                        <input type="hidden" name="forget_email" value="<?php echo $_SESSION['forget_email'] ?? ''; ?>">
                        <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                    </form>

                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        $_SESSION['error'] = '';
                    } ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo getBaseURL() ?>/login.php">Login ?</a>
                    <a href="<?php echo getBaseURL() ?>/register.php">Register ?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('forget_otpForm');
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        }, false);
    })();
</script>
<script>
    function validateForm() {
        let otp = document.forms["forget_otpForm"]["otp"].value;
        let new_password = document.forms["forget_otpForm"]["new_password"].value;
        let confirm_password = document.forms["forget_otpForm"]["confirm_password"].value;

        if (otp == "" || new_password == "" || confirm_password == "") {
            // alert("All fields must be filled out");
            return false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            // alert("Invalid email format");
            return false;
        }
        return true;
    }
</script>
<?php require $documentRoot . '/layout/footer.php'; ?>