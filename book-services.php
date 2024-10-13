<?php
session_start();
error_reporting(E_ALL); // Enable error reporting for debugging
include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['obbsuid']) == 0) {
    header('location:logout.php');
    exit();
}

// Handle the form submission
if (isset($_POST['submit'])) {
    $uid = $_SESSION['obbsuid'];  // User ID from session
    $serviceID = $_POST['servicetype']; 
    $bookingDate = $_POST['bookingdate'];
    $bookingTime = $_POST['bookingtime'];
    $numberOfWheels = $_POST['numberofwheels'];
    $vehicleNumber = $_POST['vehiclenumber'];
    $additional = !empty($_POST['additionalrepairs']) ? $_POST['additionalrepairs'] : ''; // Optional field
    $message = !empty($_POST['message']) ? $_POST['message'] : ''; // Optional field
    $bookingID = mt_rand(100000000, 999999999);  // Generate random Booking ID
    $status = "Pending";  // Default status

    try {
        // SQL query to insert data into tblbooking
        $sql = "INSERT INTO tblbooking (
                    BookingID, ServiceID, UserID, BookDate, BookTime, 
                    NumberOfWheels, vehicleNumber, Additional, Message, Status
                ) 
                VALUES (
                    :bookingID, :serviceID, :userID, :bookDate, :bookTime, 
                    :numberOfWheels, :vehicleNumber, :additional, :message, :status
                )";

        // Prepare the SQL query
        $query = $dbh->prepare($sql);

        // Bind parameters to query
        $query->bindParam(':bookingID', $bookingID, PDO::PARAM_INT);
        $query->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
        $query->bindParam(':userID', $uid, PDO::PARAM_INT);
        $query->bindParam(':bookDate', $bookingDate, PDO::PARAM_STR);
        $query->bindParam(':bookTime', $bookingTime, PDO::PARAM_STR);
        $query->bindParam(':numberOfWheels', $numberOfWheels, PDO::PARAM_STR);
        $query->bindParam(':vehicleNumber', $vehicleNumber, PDO::PARAM_STR);
        $query->bindParam(':additional', $additional, PDO::PARAM_STR);  // Bind optional field
        $query->bindParam(':message', $message, PDO::PARAM_STR);  // Bind optional field
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        // Execute the query
        if ($query->execute()) {
            echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon.")</script>';
            echo "<script>window.location.href ='services.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());  // Log error
        echo "Error: " . $e->getMessage();  // Display error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Service Center | Book Services</title>
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
                    <input type="date" class="form-input" name="bookingdate" required placeholder="Booking Date">
                    <input type="time" class="form-input" name="bookingtime" required placeholder="Booking Time">

                    <select class="form-input" name="servicetype" required>
                        <option value="">Choose Service</option>
                        <?php 
                            // Fetch available services from the database
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

                    <select class="form-input" name="numberofwheels" required>
                        <option value="">Select Vehicle Type</option>
                        <option value="2 Wheeler">2 Wheeler</option>
                        <option value="3 Wheeler">3 Wheeler</option>
                        <option value="4 Wheeler">4 Wheeler</option>
                        <option value="6 Wheeler">6 Wheeler</option>
                        <option value="10 Wheeler">10 Wheeler</option>
                    </select>

                    <input type="text" class="form-input" name="vehiclenumber" required placeholder="Vehicle Number">
                    
                    <!-- Optional additional repairs field -->
                    <input type="text" class="form-input" name="additionalrepairs" placeholder="Additional Repairs (optional)">

                    <!-- Optional message field -->
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
