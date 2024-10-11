<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perera Service Centre | Services</title>

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
        <div class="servicesdiv">
            <h1>Vehicle Services</h1>
            <p id="servicedescp">List of services we provide for vehicle maintenance and repair.</p>
            <br>
            <div class="service-container wow fadeInUp animated">
                <?php
                $sql = "SELECT * from tblservice";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() > 0) {
                    foreach ($results as $row) { ?>

                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fa fa-wrench" aria-hidden="true"></i>
                            </div>
                            <div class="service-info">
                                <h3><?php echo htmlentities($row->ServiceName); ?></h3>
                                <p><?php echo htmlentities($row->SerDes); ?></p>
                                <span class="price"><?php echo htmlentities($row->ServicePrice); ?></span>
                            </div>
                            <div class="service-action">
                                <?php if (empty($_SESSION['obbsuid'])) { ?>
                                    <br>
                                    <a href="login.php" class="btn btn-default hvr-radial-in">Book Service</a>
                                <?php } else { ?>
                                    <a href="book-services.php?bookid=<?php echo $row->ID; ?>" class="btn btn-default hvr-radial-in">Book Service</a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>

</html>
