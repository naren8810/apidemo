<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/layout/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Password Changed</h3>
                    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                        echo $_SESSION['success'];
                        $_SESSION['success'] = '';
                    } ?>
                </div>
                <div class="card-body">
                    <p>Your password is updated susscessfully for email: <?php echo $_SESSION['forget_email']; ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo getBaseURL() ?>/login.php">Login ?</a>
                    <a href="<?php echo getBaseURL() ?>/register.php">Register ?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require $documentRoot . '/layout/footer.php'; ?>