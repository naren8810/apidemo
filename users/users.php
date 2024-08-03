<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'] . '/innovins';
require $documentRoot . '/auth/auth_user.php';
require $documentRoot . '/layout/header.php';
require $documentRoot . '/layout/navbar.php';

// Pagination setup
$limit = 10; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

// Fetch user data
$sql = "SELECT id, name, email FROM users LIMIT $start_from, $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) { ?>
    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo $_SESSION['error'];
        $_SESSION['error'] = '';
    } ?>
    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        echo $_SESSION['success'];
        $_SESSION['success'] = '';
    } ?>
    <div class="container-fluid">

        <div>
            <div class="pull-right">
                <a href="<?php echo getBaseURL() ?>/users/adduser.php" class="btn btn-sm btn-primary m-4" style="float: right;">Add New User</a>
            </div>
        </div>
        <div class="table-responsive w-100 d-block d-md-table">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td> <?php echo $row["id"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td>
                                    <div class='row'>
                                        <a href='edituser.php?id=<?php echo $row["id"]; ?>' class='btn btn-success btn-sm m-2'>Edit</a>
                                        <a href='viewuser.php?id=<?php echo $row["id"]; ?>' class='btn btn-info btn-sm m-2'>View</a>
                                        <a href='delete_user.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm m-2' onclick="return confirm('Are you sure, delete this user?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                    <?php  }
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        // Pagination controls
        $sql = "SELECT COUNT(id) FROM users";
        $result = $conn->query($sql);
        $row = $result->fetch_row();
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);

        $pagLink = "<nav style='float:right'><ul class='pagination'>";

        for ($i = 1; $i <= $total_pages; $i++) {
            $acivepage = '';
            if ($i == $page) {
                $acivepage = 'active';
            }
            $pagLink .= "<li class='page-item $acivepage'><a class='page-link' href='users.php?page=" . $i . "'>" . $i . "</a></li>";
        }
        echo $pagLink . "</ul></nav>";
        ?>
    <?php } else {
    echo "0 results";
}
$conn->close();
    ?>
    </div>
    <?php require $documentRoot . '/layout/footer.php'; ?>