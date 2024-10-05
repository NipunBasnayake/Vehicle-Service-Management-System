<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Perera Service Centre | Home Page</title>

<script type="application/x-javascript"> 
    addEventListener("load", function() { 
        setTimeout(hideURLbar, 0); 
    }, false); 
    function hideURLbar(){ 
        window.scrollTo(0,1); 
    } 
</script>

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

    <div class="banner jarallax">
        <div class="container">
            <div class="w3-banner-info">
                <div class="w3l-banner-text">
                    <h2>Perera Vehicle Service</h2>
                    <p>Your One-Stop Auto Care Solution</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w3ls-banner-info-bottom">
        <div class="container">
            <div class="banner-address">
                <?php
                $sql = "SELECT * from tblpage where PageType='contactus'";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>
                        <div class="col-md-4 banner-address-left">
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo htmlentities($row->PageDescription); ?>.</p>
                        </div>
                        <div class="col-md-4 banner-address-left">
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo htmlentities($row->Email); ?></p>
                        </div>
                        <div class="col-md-4 banner-address-left">
                            <p><i class="fa fa-phone" aria-hidden="true"></i> +<?php echo htmlentities($row->MobileNumber); ?></p>
                        </div>
                        <div class="clearfix"></div>
                <?php }
                } ?>
            </div>
        </div>
    </div>

    <div class="banner-bottom">
        <div class="container">
            <div class="wthree-bottom-grids">
                <div class="col-md-6 wthree-bottom-grid">
                    <div class="w3-agileits-bottom-left">
                        <div class="w3-agileits-bottom-left-text">
                            <h3>Comprehensive Vehicle Maintenance</h3>
                            <p>We provide full service from routine maintenance to major repairs, keeping your vehicle running smoothly.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wthree-bottom-grid">
                    <div class="w3-agileits-bottom-left w3-agileits-bottom-right">
                        <div class="w3-agileits-bottom-left-text">
                            <h3>Trust Our Highly Certified Technicians</h3>
                            <p>Our experienced technicians are here to help with all your automotive needs, ensuring quality service every time.</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once('includes/footer.php');?>

    <!-- Scripts -->
    <script src="js/jarallax.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script type="text/javascript">
        /* init Jarallax */
        $('.jarallax').jarallax({
            speed: 0.5,
            imgWidth: 1366,
            imgHeight: 768
        });
    </script>
    <script src="js/modernizr.custom.js"></script>
</body>

</html>