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
        <div>
            <table id="homeTable">
                <tr>
                    <td class="homeColBanner">
                        <h1>Comprehensive Vehicle Maintenance</h1>
                        <br>
                        <h4>We provide full service from routine maintenance to major repairs, keeping your vehicle running smoothly.</h4>
                    </td>
                    <td></td>
                    <td class="homeColBanner">
                        <h1>Trust Our Highly Certified Technicians</h1>
                        <br>
                        <h4>Our experienced technicians are here to help with all your automotive needs, ensuring quality service every time.</h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
</body>

</html>