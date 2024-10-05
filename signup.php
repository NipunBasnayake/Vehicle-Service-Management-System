<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
if(isset($_POST['signup']))
  {
    $fname=$_POST['fname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret="select Email from tbluser where Email=:email";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{
$sql="Insert Into tbluser(FullName,MobileNumber,Email,Password)Values(:fname,:mobno,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('You have signup  Scuccessfully');</script>";
}
else
{

echo "<script>alert('Something went wrong.Please try again');</script>";
}
}
 else
{

echo "<script>alert('Email-id already exist. Please try again');</script>";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perera Service Centre | Register</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- FontAwesome Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">

    <!-- jQuery and Bootstrap JS -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include_once('includes/header.php'); ?>

    <!-- Main Banner Section -->
    <div class="banner jarallax">
    <div class="overlay">
        <div class="container">
            <h2 class="page-title">Register</h2>
            <div class="col-md-6 col-md-offset-3 form-container">
                <div class="form-header">
                    <h3 class="form-title">Register Yourself</h3>
                </div>
                <div class="form-body">
                    <form method="post" name="signup" onsubmit="return checkpass();">
                        <input type="text" name="fullname" placeholder="Full Name" required="true" class="form-input">
                        <input type="email" name="email" placeholder="E-mail" required="true" class="form-input">
                        <input type="text" name="mobile" placeholder="Mobile Number" required="true" class="form-input" maxlength="10" pattern="[0-9]+">
                        <input type="password" name="password" placeholder="Password" required="true" class="form-input" id="password1">
                        <br>
                        <input type="password" name="confirmpassword" placeholder="Confirm Password" required="true" class="form-input" id="password2">
                        <br>
                        <button class="btn-submit" name="signup">Register NOW</button>
                    </form>
                    <br>
                    <div class="text-center">
                        <a href="login.php">Already have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- jarallax -->
    <script src="js/jarallax.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script type="text/javascript">
        /* init Jarallax */
        $('.jarallax').jarallax({
            speed: 0.5,
            imgWidth: 1366,
            imgHeight: 768
        });
    </script>

    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <!-- Scroll to top -->
    <script type="text/javascript">
        $(document).ready(function () {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
</body>
</html>
