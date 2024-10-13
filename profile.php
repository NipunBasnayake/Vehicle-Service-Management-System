<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $uid=$_SESSION['obbsuid'];
    $AName=$_POST['fname'];
    $mobno=$_POST['mobno']; 
 
  $sql="update tbluser set FullName=:name,MobileNumber=:mobno where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':name',$AName,PDO::PARAM_STR);
     $query->bindParam(':mobno',$mobno,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();

        echo '<script>alert("Profile has been updated")</script>';
echo "<script>window.location.href ='profile.php'</script>";

     

  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Online Banquet Booking System | User Profile</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 


</head>
<body>
	<?php include_once('includes/header.php');?>

        <div class="backgroundImg">
            <div class="logindiv">
                <h1>User Profile</h1>
                <br>
                <div class="form-body">
                    <form method="post">
                        <?php
                        $uid = $_SESSION['obbsuid'];
                        $sql = "SELECT * from tbluser where ID=:uid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {
                        ?>
                        <div class="form-group row">
                            <input type="text" value="<?php echo $row->FullName; ?>" 
                                   name="fname" required="true" class="form-input" placeholder="Full Name">
                            <input type="text" name="mobno" class="form-input" 
                                   required="true" maxlength="10" pattern="[0-9]+" 
                                   value="<?php echo $row->MobileNumber; ?>" placeholder="Mobile Number">
                            <input type="email" class="form-input" value="<?php echo $row->Email; ?>" 
                                   name="email" required="true" readonly 
                                   title="Email can't be edit">
                            <input type="text" value="<?php echo $row->RegDate; ?>" 
                                   class="form-input" name="password" readonly="true">
                        </div>
                        <?php $cnt = $cnt + 1; }} ?>
                        <br>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>

	<?php include_once('includes/footer.php');?>
</body>	

</html>
<?php }  ?>