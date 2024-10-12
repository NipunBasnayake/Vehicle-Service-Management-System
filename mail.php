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
    <title>Perera Service Centre | Contact</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet"> 

    <link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>

</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="backgroundImg">
        <div class="contactdiv">
            <div class="col-md-6 contact-form-left">
                <!-- Contact Info -->
                <div class="contactinfocol">
                    <h3>Contact Us</h3>
                    <?php
                    $sql = "SELECT * FROM tblpage WHERE PageType='contactus'";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) { ?>
                            <p>
                                <i class="fa fa-phone" aria-hidden="true"></i> <span>+<?php echo htmlentities($row->MobileNumber); ?></span>
                                &emsp;&emsp;|&emsp;&emsp;
                                <i class="fa fa-envelope" aria-hidden="true"></i> <span><?php echo htmlentities($row->Email); ?></span>
                                &emsp;&emsp;|&emsp;&emsp;
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <span><?php echo htmlentities($row->PageDescription); ?>.</span>
                            </p>
                        <?php }
                    } ?>
                </div>

                <!-- Message Form -->
                <div class="messagecol">
                    <h3>Send us a message</h3>
                    <form action="#" method="post">
                        <input type="text" name="name" placeholder="Full Name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <textarea name="message" placeholder="Message" required></textarea>
                        <button class="btn1" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>



</body>
</html>
