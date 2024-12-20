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
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT ID FROM tbluser WHERE ID=:uid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tbluser set Password=:newpassword where ID=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';

}



}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Online Banquet Booking System | Change Password</title>

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

	<script type="text/javascript">
	function checkpass()
	{
	if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
	{
	alert('New Password and Confirm Password field does not match');
	document.changepassword.confirmpassword.focus();
	return false;
	}
	return true;
	}   

	</script>
</head>
<body>
	<?php include_once('includes/header.php');?>
	
	<div class="backgroundImg">
        <div class="logindiv">
			<h1>Change Password</h1>
			<br>
			<div class="form-body">
				<form method="post" onsubmit="return checkpass();" name="changepassword">
                    <input type="password" class="form-input" required="true" name="currentpassword" placeholder="Old Password">
                    <input type="password" class="form-input" required="true" name="newpassword" placeholder="New Password">
                    <input type="password" class="form-input" required="true" name="confirmpassword" placeholder="Confirm Password">
                    <button type="submit" class="btn-submit" name="submit">Change</button>
                </form>
	        </div>
        </div>
    </div>

	<?php include_once('includes/footer.php');?>

</body>	
</html><?php }  ?>