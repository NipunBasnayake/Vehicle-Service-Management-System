<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['obbsuid']==0)) {
  header('location:logout.php');
  } else{
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Perera Service Centre | Booking History </title>

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
		<div class="historydiv">
			<h1>Booking History</h1>
			<p>List of bookings</p>

			<table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th>Booking ID</th>
                        <th>Customer Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Booking Date</th>
                        <th>Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $uid=$_SESSION['obbsuid'];
                    $sql="SELECT tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.BookingID,tblbooking.BookingDate,tblbooking.Status,tblbooking.ID from tblbooking join tbluser on tbluser.ID=tblbooking.UserID where tblbooking.UserID='$uid'";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0) {
                    foreach($results as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                        <td><?php echo htmlentities($row->BookingID);?></td>
                        <td><?php echo htmlentities($row->FullName);?></td>
                        <td><?php echo htmlentities($row->MobileNumber);?></td>
                        <td><?php echo htmlentities($row->Email);?></td>
                        <td><span class="badge badge-primary"><?php echo htmlentities($row->BookingDate);?></span></td>
                        <td><?php echo $row->Status ? htmlentities($row->Status) : "Not Updated Yet"; ?></td>
                        td><a href="view-booking-detail.php?editid=<?php echo htmlentities ($row->ID);?>&&bookingid=<?php echo htmlentities ($row->BookingID);?>" class="btn btn-primary">View</a></td>
                    </tr>
                    <?php $cnt=$cnt+1;}} ?> 
                </tbody>
            </table>

		</div>
	</div>

    <?php include_once('includes/footer.php');?>

</body>	
</html><?php }  ?>