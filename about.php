<?php
session_start();
error_reporting(0);

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perera Service Centre | About</title>

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
        <div class="about-content">
            <?php
            $sql = "SELECT * FROM tblpage WHERE PageType='aboutus'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if ($query->rowCount() > 0) {
                foreach ($results as $row) { ?>

                    <h1 class="about-title">
                        <?php echo htmlspecialchars($row->PageTitle); ?>
                    </h1>
                    <div class="about-description">
                        <?php echo html_entity_decode($row->PageDescription); ?>
                    </div>

                <?php }
            }
            ?>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>

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
