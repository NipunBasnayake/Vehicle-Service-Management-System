<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if (isset($_POST['signup'])) {
    $fname = $_POST['fullname'];
    $mobno = $_POST['mobile'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $ret = "SELECT Email FROM tbluser WHERE Email=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() == 0) {
        $sql = "INSERT INTO tbluser (FullName, MobileNumber, Email, Password) 
                VALUES (:fname, :mobno, :email, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('You have signed up successfully');</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } else {
        echo "<script>alert('Email-id already exists. Please try again');</script>";
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

    <script>
        function checkpass() {
            let password = document.getElementById('password1').value;
            let confirmpassword = document.getElementById('password2').value;

            if (password !== confirmpassword) {
                alert('Passwords do not match!');
                return false;
            }
            return true;
        }
    </script>
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
                    <input type="text" name="fullname" placeholder="Full Name" required class="form-input">
                    <input type="email" name="email" placeholder="E-mail" required class="form-input">
                    <input type="text" name="mobile" placeholder="Mobile Number" required 
                           class="form-input" maxlength="10" pattern="[0-9]+">
                    <input type="password" name="password" placeholder="Password" required 
                           class="form-input" id="password1">
                    <br>
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" required 
                           class="form-input" id="password2">
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
