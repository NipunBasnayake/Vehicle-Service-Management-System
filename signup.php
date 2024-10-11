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

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="backgroundImg">
        <div class="logindiv">
            <h1>Register</h1>
            <h3>Register Yourself</h3>
            <br>
            
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

    <?php include_once('includes/footer.php'); ?>
</body>

</html>
