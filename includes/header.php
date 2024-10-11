<?php
    $currentPage = basename($_SERVER['PHP_SELF'], ".php");
?>


<div class="header">

    <div class="headerlogodiv">
        <a href="index.php"><img src="homeImages/logo.png" alt="Logo" style="height: 50px;"/></a>
    </div>

    <div class="navlinksdiv">
        <ul class="nav navbar-nav">
            <li class="<?php if ($currentPage == 'index') echo 'active'; ?>"><a href="index.php">Home</a></li>
            <li class="<?php if ($currentPage == 'about') echo 'active'; ?>"><a href="about.php">About</a></li>
            <li class="<?php if ($currentPage == 'services') echo 'active'; ?>"><a href="services.php">Services</a></li>

            <?php if (strlen($_SESSION['obbsuid'] != 0)) { ?>
            <li class="<?php if ($currentPage == 'my-account') echo 'active'; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    My Account <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="booking-history.php">Booking History</a></li>
                    <li><a href="change-password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
                <?php } ?>
            <li class="<?php if ($currentPage == 'mail') echo 'active'; ?>"><a href="mail.php">Contact Us</a></li>
         </ul>
    </div>

    <div class="rightlinksdiv">
    <?php if (strlen($_SESSION['obbsuid'] == 0)) { ?>
        <div class="auth-links">
            <ul class="auth-menu">
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Register</a></li>
                <li><a href="admin/login.php">Admin</a></li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>



