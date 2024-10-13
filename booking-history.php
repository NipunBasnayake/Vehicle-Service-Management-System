<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['obbsuid']) == 0) {
    header('location:logout.php');
} else {
    $uid = $_SESSION['obbsuid'];

    // Updated SQL query to include service details
    $sql = "SELECT 
                tbluser.FullName,
                tbluser.MobileNumber,
                tbluser.Email,
                tblbooking.BookingID,
                tblbooking.BookDate,
                tblbooking.BookTime,
                tblbooking.EventType,
                tblbooking.NumberOfWheels,
                tblbooking.Message,
                tblbooking.Status,
                tblservice.ServiceName
            FROM 
                tblbooking 
            JOIN 
                tbluser ON tbluser.ID = tblbooking.UserID 
            JOIN 
                tblservice ON tblservice.ID = tblbooking.ServiceID 
            WHERE 
                tblbooking.UserID = :userid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':userid', $uid, PDO::PARAM_INT);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Perera Service Centre | Booking History</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.js"></script>
    </head>
    <body>
        <?php include_once('includes/header.php'); ?>

        <div class="backgroundImg">
            <div class="historydiv">
                <h1>Booking History</h1>
                <p>List of bookings</p>
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Booking ID</th>
                            <th>Name</th>
                            <th>Booked Date</th>
                            <th>Booked Time</th>
                            <th>Service</th>
                            <th>Vehicle Type</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) { ?>
                                <tr>
                                    <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($row->BookingID); ?></td>
                                    <td><?php echo htmlentities($row->FullName); ?></td>
                                    <td><?php echo htmlentities($row->BookDate); ?></td>
                                    <td><?php echo htmlentities($row->BookTime); ?></td>
                                    <td><?php echo htmlentities($row->ServiceName); ?></td>
                                    <td><?php echo htmlentities($row->NumberOfWheels); ?></td>
                                    <td><?php echo htmlentities($row->Message); ?></td>
                                    <td><?php echo $row->Status ? htmlentities($row->Status) : "Not Updated Yet"; ?></td>
                                    <td><a href="view-booking-detail.php?editid=<?php echo htmlentities($row->BookingID); ?>" class="btn btn-primary">View</a></td>
                                </tr>
                            <?php 
                            $cnt++;
                            }
                        } else { 
                            echo '<tr><td colspan="10" class="text-center">No bookings found.</td></tr>'; 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include_once('includes/footer.php'); ?>
    </body>
    </html>
<?php } ?>
