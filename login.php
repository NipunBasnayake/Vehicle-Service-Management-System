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

    <!-- bootstrap-css -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- css -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- fonts -->
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
    <!-- jquery and bootstrap -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include_once('includes/header.php');?>

   <!-- Banner -->
   <div class="banner jarallax">
    <div class="overlay">
        <div class="container">
            <h2 class="page-title">Login</h2>
            <div class="col-md-6 col-md-offset-3 form-container">
                <div class="form-header">
                    <h3 class="form-title">Login to User Panel</h3>
                </div>
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
                    <div class="text-center">
                        <a href="signup.php">Register Yourself</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


	
    <!-- Footer -->
    <?php include_once('includes/footer.php');?>

</body>
</html>
