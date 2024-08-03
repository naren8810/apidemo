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
                    <h3>View User</h3>

                    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        $_SESSION['success'] = '';
                    } ?>
                </div>
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $user_data['id'] ?? ''; ?>">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <?php echo $user_data['name'] ?? ''; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <?php echo $user_data['email'] ?? ''; ?>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="users.php">Users</a>
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
</body>

</html>