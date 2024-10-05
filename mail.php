<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO tblcontact(Name, Email, Message) VALUES(:name, :email, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->execute();

    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo "<script>alert('Your message was sent successfully!');</script>";
        echo "<script>window.location.href ='mail.php'</script>";
    } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perera Service Centre | Contact</title>

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Custom CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Fonts -->
	 
    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.js"></script>

    <script type="text/javascript">
        // Smooth scrolling effect
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });

        // Hide URL bar on load
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar(){
            window.scrollTo(0, 1);
        }
    </script>
</head>

<body>
    <!-- Header Section -->
    <?php include_once('includes/header.php'); ?>

    <!-- Banner Section -->
    <div class="banner jarallax">
        <div class="agileinfo-dot">
            <div class="wthree-heading">
                <div class="container">
                    <h2>Contact</h2>

                    <!-- Contact Form Section -->
                    <div class="agile-contact-form">
                        <div class="row">
                            <!-- Contact Info -->
							<div class="col-md-6 contact-form-left">
								<div class="w3layouts-contact-form-top">
									<h3>Get in Touch</h3>
									<p>Pellentesque eget mi nec est tincidunt accumsan. Proin fermentum dignissim justo, vel euismod justo sodales vel. In non condimentum mauris. Maecenas condimentum interdum lacus, ac varius nisl dignissim ac.</p>
								</div>
								<div class="agileits-contact-address">
									<ul class="list-unstyled text-left">
										<?php
										$sql = "SELECT * FROM tblpage WHERE PageType='contactus'";
										$query = $dbh->prepare($sql);
										$query->execute();
										$results = $query->fetchAll(PDO::FETCH_OBJ);

										if ($query->rowCount() > 0) {
											foreach ($results as $row) { ?>
												<li><i class="fa fa-phone" aria-hidden="true"></i> <span>+<?php echo htmlentities($row->MobileNumber); ?></span></li>
												<li><i class="fa fa-envelope" aria-hidden="true"></i> <span><?php echo htmlentities($row->Email); ?></span></li>
												<li><i class="fa fa-map-marker" aria-hidden="true"></i> <span><?php echo htmlentities($row->PageDescription); ?>.</span></li>
										<?php } } ?>
									</ul>
								</div>
							</div>

                            <!-- Message Form -->
                            <div class="col-md-6 contact-form-right">
                                <div class="contact-form-top">
                                    <h3>Send us a message</h3>
                                </div>
                                <div class="agileinfo-contact-form-grid">
                                    <form action="#" method="post">
                                        <input type="text" name="name" placeholder="Full Name" required>
                                        <input type="email" name="email" placeholder="Email" required>
                                        <textarea name="message" placeholder="Message" required></textarea>
                                        <button class="btn1" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- End of Contact Form Section -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include_once('includes/footer.php'); ?>

    <!-- Jarallax and Smooth Scroll JS -->
    <script src="js/jarallax.js"></script>
    <script src="js/SmoothScroll.min.js"></script>
    <script type="text/javascript">
        // Initialize Jarallax
        $('.jarallax').jarallax({
            speed: 0.5,
            imgWidth: 1366,
            imgHeight: 768
        });
    </script>

    <!-- Scroll to Top Icon -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $().UItoTop({ easingType: 'easeOutQuart' });
        });
    </script>

    <!-- Modernizr -->
    <script src="js/modernizr.custom.js"></script>
</body>
</html>
