<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['obbsuid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    // Collect form inputs
    $uid = $_SESSION['obbsuid'];
    $serviceID = $_POST['servicetype']; 
    $bookingDate = $_POST['bookingdate'];
    $bookingTime = $_POST['bookingtime'];
    $eventType = $_POST['eventtype'];
    $numberOfWheels = $_POST['numberofwheels'];
    $vehicleNumber = $_POST['vehiclenumber'];
    $additionalRepairs = $_POST['additionalrepairs'];
    $message = $_POST['message'] ?? ''; // Optional message
    $bookingID = mt_rand(100000000, 999999999); // Random Booking ID
    $status = "Pending";  // Default status

    try {
        // SQL query to insert booking data
        $sql = "INSERT INTO tblbooking (BookingID, ServiceID, UserID, BookDate, BookTime, EventType, 
                NumberOfWheels, Message, Status) 
                VALUES (:bookingID, :serviceID, :userID, :bookDate, :bookTime, :eventType, 
                :numberOfWheels, :message, :status)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingID', $bookingID, PDO::PARAM_INT);
        $query->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
        $query->bindParam(':userID', $uid, PDO::PARAM_INT);
        $query->bindParam(':bookDate', $bookingDate, PDO::PARAM_STR);
        $query->bindParam(':bookTime', $bookingTime, PDO::PARAM_STR);
        $query->bindParam(':eventType', $eventType, PDO::PARAM_STR);
        $query->bindParam(':numberOfWheels', $numberOfWheels, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        // Execute and check if the query was successful
        if ($query->execute()) {
            echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon.")</script>';
            echo "<script>window.location.href ='services.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    } catch (PDOException $e) {
        // Display detailed error message (for debugging)
        echo "Error: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Banquet Booking System | Book Services</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="backgroundImg">
        <div class="logindiv">
            <h1>Booking Services</h1>
            <br>
            <div class="form-body">
                <form method="post">
                    <input type="date" class="form-input" name="bookingdate" required="true" placeholder="Booking Date">
                    <input type="time" class="form-input" name="bookingtime" required="true" placeholder="Booking Time">

                    <select class="form-input" name="servicetype" required="true" id="formselect">
                        <option value="">Choose Service</option>
                        <?php 
                            $sql2 = "SELECT * FROM tblservice";
                            $query2 = $dbh->prepare($sql2);
                            $query2->execute();
                            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);

                            foreach ($result2 as $row) {          
                        ?>  
                            <option value="<?php echo htmlentities($row->ID); ?>">
                                <?php echo htmlentities($row->ServiceName); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <select class="form-input" name="numberofwheels" required="true" id="formselect">
                        <option value="">Select Vehicle Type</option>
                        <option value="2 Wheeler">2 Wheeler</option>
                        <option value="3 Wheeler">3 Wheeler</option>
                        <option value="4 Wheeler">4 Wheeler</option>
                        <option value="6 Wheeler">6 Wheeler</option>
                        <option value="10 Wheeler">10 Wheeler</option>
                    </select>

                    <input type="text" class="form-input" name="vehiclenumber" placeholder="Vehicle Number" required="true">
                    <input type="text" class="form-input" name="additionalrepairs" placeholder="Additional Repairs (optional)">
                    <textarea class="form-input" name="message" placeholder="Message (optional)"></textarea>

                    <button class="btn-submit" type="reset">Clear All</button>
                    <button class="btn-submit" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
