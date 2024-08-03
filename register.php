<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/layout/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form id="registerForm" novalidate method="POST" action="auth/auth_register.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" name="name" class="form-control" id="name" placeholder="Enter name" value="<?php echo $_SESSION['input_name'] ?? ''; ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid name.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['input_email'] ?? ''; ?>" placeholder="Enter email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?php echo $_SESSION['input_password'] ?? ''; ?>" required minlength="6">
                            <div class="invalid-feedback">
                                Password must be at least 6 characters long.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>

                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        $_SESSION['error'] = '';
                    } ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo getBaseURL() ?>/login.php">Login ?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('registerForm');
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
        let name = document.forms["registerForm"]["name"].value;
        let email = document.forms["registerForm"]["email"].value;
        let password = document.forms["registerForm"]["password"].value;

        if (name == "" || email == "" || password == "") {
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