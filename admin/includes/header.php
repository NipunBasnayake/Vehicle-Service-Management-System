<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['odmsaid']) == 0) {
    header('location:logout.php');
    exit();
} else {
?>

<header id="page-header" style="background-color: #fff; border-bottom: 1px solid #ddd;">
    <div class="content-header d-flex justify-content-between align-items-center">
        <div class="content-header-section">
            <ul class="adminNavBar">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        Service <span class="caret"></span>
                    </a>
                    <ul class="dropdown">
                        <li><a href="add-services.php">Add Services</a></li>
                        <li><a href="manage-services.php">Manage Services</a></li>
                    </ul>
                </li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        Booking <span class="caret"></span>
                    </a>
                    <ul class="dropdown">
                        <li><a href="new-booking.php">New Bookings</a></li>
                        <li><a href="approved-booking.php">Approved Bookings</a></li>
                        <li><a href="cancelled-booking.php">Cancelled Bookings</a></li>
                        <li><a href="all-booking.php">All Bookings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                        Messages <span class="caret"></span>
                    </a>
                    <ul class="dropdown">
                        <li><a href="unread-queries.php">Unread Messages</a></li>
                        <li><a href="read-queries.php">Read Messages</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="content-header-section">
            <div class="btn-group" role="group">
                <?php
                $aid = $_SESSION['odmsaid'];
                $sql = "SELECT AdminName FROM tbladmin WHERE ID=:aid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() > 0) {
                    foreach ($results as $row) {
                ?>
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <?php echo htmlentities($row->AdminName); ?>
                        </button>
                <?php
                    }
                }
                ?>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="admin-profile.php">
                        <i class="fas fa-user-circle mr-2"></i> Profile
                    </a>
                    <a class="dropdown-item" href="change-password.php">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .btn-group {
        margin-right: 30px;
    }

    .adminNavBar {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
        background-color: #fff;
    }

    .adminNavBar > li {
        position: relative;
        margin-right: 20px;
    }

    .adminNavBar > li > a {
        color: #000;
        padding: 15px 20px;
        text-decoration: none;
        display: block;
    }

    .adminNavBar > li > a:hover {
        background-color: #f0f0f0;
    }

    .dropdown {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        min-width: 150px;
        z-index: 1000;
    }

    .adminNavBar > li:hover .dropdown {
        display: block;
    }

    .dropdown li {
        padding: 0;
    }

    .dropdown a {
        color: #000;
        padding: 10px 15px;
        display: block;
    }

    .dropdown a:hover {
        background-color: #f0f0f0;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php } ?>
