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
	<!-- bootstrap-css -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--// bootstrap-css -->
	<!-- css -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--// css -->
	<!-- font-awesome icons -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<!-- font -->
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
	<!-- //font -->
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
	<!-- Header -->
	<?php include_once('includes/header.php');?>

	<!-- banner -->
	<div class="banner jarallax">
        <div class="overlay">
            <div class="container">
                <h2 class="page-title">Booking History</h2>
                <p class="wow fadeInUp animated" data-wow-delay=".5s">List of bookings</p>
                <div class="table-container wow fadeInUp animated" data-wow-delay=".5s">
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
                                <td><a href="view-booking-detail.php?editid=<?php echo htmlentities ($row->ID);?>&&bookingid=<?php echo htmlentities ($row->BookingID);?>" class="btn btn-primary">View</a></td>
                            </tr>
                            <?php $cnt=$cnt+1;}} ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('includes/footer.php');?>




	<!-- jarallax -->
	<script src="js/jarallax.js"></script>
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript">
		/* init Jarallax */
		$('.jarallax').jarallax({
			speed: 0.5,
			imgWidth: 1366,
			imgHeight: 768
		})
	</script>
	<!-- //jarallax -->
	<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/modernizr.custom.js"></script>

</body>	
</html><?php }  ?>