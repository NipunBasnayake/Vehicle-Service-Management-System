<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Perera Service Centre | Services</title>

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

    <!-- banner -->
    <div class="banner jarallax">
    <div class="agileinfo-dot">
        <div class="wthree-heading">
            <div class="container">
                <h2>Vehicle Services</h2>
                <p class="wow fadeInUp animated" data-wow-delay=".5s">
                    List of services we provide for vehicle maintenance and repair.
                </p>
                <br>
                <!-- Service Cards Section -->
                <div class="wthree-services-bottom-grids">
                    <div class="service-container wow fadeInUp animated" data-wow-delay=".5s">
                        <?php
                        $sql = "SELECT * from tblservice";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) { ?>
                                <!-- Individual Service Card -->
                                <div class="service-card">
                                    <div class="service-icon">
                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                    </div>
                                    <div class="service-info">
                                        <h3><?php echo htmlentities($row->ServiceName); ?></h3>
                                        <p><?php echo htmlentities($row->SerDes); ?></p>
                                        <span class="price">$<?php echo htmlentities($row->ServicePrice); ?></span>
                                    </div>
                                    <div class="service-action">
                                        <?php if (empty($_SESSION['obbsuid'])) { ?>
                                            <br>
                                            <a href="login.php" class="btn btn-default hvr-radial-in">Book Service</a>
                                        <?php } else { ?>
                                            <a href="book-service.php?bookid=<?php echo $row->ID; ?>" class="btn btn-default hvr-radial-in">Book Service</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- End of Service Cards Section -->

            </div>
        </div>
    </div>
</div>


    <div class="about-top"></div>

    <!-- Footer -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Jarallax -->
    <script src="js/jarallax.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script>
        // Init Jarallax
        $('.jarallax').jarallax({
            speed: 0.5,
            imgWidth: 1366,
            imgHeight: 768
        });
    </script>

    <!-- Scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        $(document).ready(function () {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>

    <script src="js/modernizr.custom.js"></script>
</body>

</html>
