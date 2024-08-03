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
                    <h3>Forget Password</h3>
                    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        $_SESSION['success'] = '';
                    } ?>
                </div>
                <div class="card-body">
                    <form id="forgetForm" novalidate method="POST" action="../auth/auth_forget.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $user_data['email'] ?? ''; ?>" placeholder="Enter email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send OTP</button>
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
            var form = document.getElementById('forgetForm');
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
        let email = document.forms["forgetForm"]["email"].value;

        if (email == "") {
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