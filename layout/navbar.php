<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">innovins</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav font-weight-bold">
            <li class="nav-item">
                <a class="nav-link <?php echo $active_nav_home; ?>" aria-current="page" href="<?php echo getBaseURL() ?>/dashboard.php">Home</a>
            </li>
            <?php if (isset($_SESSION['super_admin']) && !empty($_SESSION['super_admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $active_nav_users; ?>" href="<?php echo getBaseURL() ?>/users/users.php">Users</a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION['super_admin']) && !empty($_SESSION['super_admin'])) { ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $active_nav_products; ?>" href="<?php echo getBaseURL() ?>/products.php">Products</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $active_nav_profile; ?>" href="<?php echo getBaseURL() ?>/profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo getBaseURL() ?>/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>