<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if(isset($_POST['login'])) 
{
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbluser WHERE Email=:email and Password=:password";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    
    if($query->rowCount() > 0)
    {
        foreach ($results as $result) {
            $_SESSION['obbsuid']=$result->ID;
        }
        $_SESSION['login']=$_POST['email'];
        echo "<script type='text/javascript'> document.location ='index.php'; </script>";
    }
    else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Perera Service Centre | Login</title>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
</head>

<body>
    <?php include_once('includes/header.php');?>

    <div class="backgroundImg">
        <div class="logindiv">
            <h1>Login</h1>
            <h3>Login to as a new User</h3>
            <br>
            <div class="form-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="login">
                    <input type="email" name="email" placeholder="E-mail" required="true" class="form-input">
                    <input type="password" name="password" placeholder="Password" required="true" class="form-input">
                    <br>
                    <div class="forgot-password text-right">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    <br>
                    <button class="btn-submit" name="login">LOGIN NOW</button>
                </form>
                <br>
                <p>Are you a new customer. <a href="signup.php">Register Now</a></p>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>

</body>

</html>
