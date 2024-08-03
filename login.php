<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';

require $documentRoot . '/auth/auth_user.php';
require $documentRoot . '/layout/header.php';  ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form id="loginForm" novalidate method="POST" action="./auth/auth_login.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required minlength="6">
                            <div class="invalid-feedback">
                                Password must be at least 6 characters long.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        $_SESSION['error'] = '';
                    } ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo getBaseURL() ?>/forget/forget.php">Forgot Password?</a>
                    <a href="<?php echo getBaseURL() ?>/register.php">Register?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('loginForm');
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
        let email = document.forms["loginForm"]["email"].value;
        let password = document.forms["loginForm"]["password"].value;

        if (email == "" || password == "") {
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