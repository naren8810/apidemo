<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/auth/auth_user.php';
require $documentRoot . '/layout/header.php';
require $documentRoot . '/layout/navbar.php';

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
                    <h3>Edit User</h3>
                    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        $_SESSION['success'] = '';
                    } ?>
                </div>
                <div class="card-body">
                    <form id="profileForm" novalidate method="POST" action="../auth/auth_edituser.php" onsubmit="return validateForm()">
                        <input type="hidden" name="id" value="<?php echo $user_data['id'] ?? ''; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" name="name" class="form-control" id="name" placeholder="Enter name" value="<?php echo $user_data['name'] ?? ''; ?>" required>
                            <div class="invalid-feedback">
                                Please enter a valid name.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $user_data['email'] ?? ''; ?>" placeholder="Enter email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>

                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        $_SESSION['error'] = '';
                    } ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo getBaseURL() ?>/users/users.php">Users</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require $documentRoot . '/layout/footer.php'; ?>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('profileForm');
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
        let name = document.forms["profileForm"]["name"].value;
        let email = document.forms["profileForm"]["email"].value;
        let password = document.forms["profileForm"]["password"].value;

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
</body>

</html>