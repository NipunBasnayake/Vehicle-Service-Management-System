<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perera Service Centre | Home Page</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>

</head>

<body>
    <?php include_once('includes/header.php');?>

    <div class="backgroundImg">
        <div id="headingdiv">
            <h1 id="headingh1">Perera Vehicle Service</h1>
            <p id="headingp">Your One-Stop Auto Care Solution</p>
        </div>
    </div>

    <div class="services-section">
        <div class="service-item">
            <h2>Comprehensive Vehicle Maintenance</h2>
            <p>We provide full service from routine maintenance to major repairs, keeping your vehicle running smoothly.</p>
        </div>
        <div class="service-item">
            <h2>Trust Our Highly Certified Technicians</h2>
            <p>Our experienced technicians are here to help with all your automotive needs, ensuring quality service every time.</p>
        </div>
    </div>

    <button id="scrollTopBtn" title="Go to top">
        <i class="fa fa-arrow-up">^</i>
    </button>

    <?php include_once('includes/footer.php');?>

    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 200) {
                $('#scrollTopBtn').fadeIn();
            } else {
                $('#scrollTopBtn').fadeOut();
            }
        });

        $('#scrollTopBtn').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
            return false;
        });
    </script>
</body>

</html>
