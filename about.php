<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Perera Service Centre | About</title>

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
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<![endif]-->
</head>

<body>
	<!-- Header -->
	<?php include_once('includes/header.php'); ?>

    <!-- Banner -->
	<div class="banner jarallax" style="background: url('homeImages/13.jpg') no-repeat center center; background-size: cover;">
		<div class="container">
			<div class="wthree-services-bottom-grids">
				<!-- Image Section -->
				<div class="col-md-6 wthree-services-left">
					<img src="homeImages/3.jpg" alt="Vehicle Service Center" class="responsive-image">
				</div>
				<!-- Text Section -->
				<div class="col-md-6 wthree-services-right">
					<div class="wthree-services-right-top">
						<?php
							$sql = "SELECT * FROM tblpage WHERE PageType='aboutus'";
							$query = $dbh->prepare($sql);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);

							if ($query->rowCount() > 0) {
								foreach ($results as $row) { ?>
									<h4 class="section-title">
										<?php echo htmlentities($row->PageTitle); ?>
									</h4>
									<p class="section-description">
										<?php echo $row->PageDescription; ?>
									</p>
						<?php
								}
							}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
    <!-- //Banner -->

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>
    
    <!-- JS Scripts -->
    <script src="js/jarallax.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script type="text/javascript">
        $('.jarallax').jarallax({ speed: 0.5, imgWidth: 1366, imgHeight: 768 });
    </script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>
</body>

</html>
