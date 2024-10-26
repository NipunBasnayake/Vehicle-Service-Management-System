<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['odmsaid']) == 0) {
    header('location:login.php');
    exit();
} else {
    $uid = $_SESSION['odmsaid'];

    // Prepare the SQL query to fetch new bookings
// Modify the SQL query to fetch all new bookings (no UserID filter)
$sql = "SELECT 
            tblbooking.BookingID,
            tbluser.FullName,
            tblbooking.BookDate,
            tblbooking.BookTime,
            tblservice.ServiceName,
            tblbooking.vehicleNumber,
            tblbooking.NumberOfWheels,
            tblbooking.additional,
            tblbooking.Message,
            tblbooking.Status
        FROM 
            tblbooking 
        JOIN 
            tbluser ON tbluser.ID = tblbooking.UserID 
        JOIN 
            tblservice ON tblservice.ID = tblbooking.ServiceID 
        WHERE 
            tblbooking.Status = 'Pending'";

    $query = $dbh->prepare($sql);

try {
    $query->execute();
} catch (Exception $e) {
    echo "Query failed: " . $e->getMessage();
    exit();
}

    $results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
<head>
    <title>PVSC Admin | New Booking</title>
    <link rel="stylesheet" href="assets/css/codebase.min.css">
</head>
<body>
    <main id="main-container">
        <div class="content">
            <h2 class="content-heading">New Bookings</h2>

            <div class="mb-3">
                <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
            </div>

            <div class="block">
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Booking ID</th>
                                <th>Full Name</th>
                                <th>Booked Date</th>
                                <th>Booked Time</th>
                                <th>Service</th>
                                <th>Vehicle Number</th>
                                <th>Number of Wheels</th>
                                <th>Additional</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query->rowCount() > 0) {
                                foreach ($results as $index => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlentities($index + 1); ?></td>
                                        <td><?php echo htmlentities($row->BookingID); ?></td>
                                        <td><?php echo htmlentities($row->FullName); ?></td>
                                        <td><?php echo htmlentities($row->BookDate); ?></td>
                                        <td><?php echo htmlentities($row->BookTime); ?></td>
                                        <td><?php echo htmlentities($row->ServiceName); ?></td>
                                        <td><?php echo htmlentities($row->vehicleNumber); ?></td>
                                        <td><?php echo htmlentities($row->NumberOfWheels); ?></td>
                                        <td><?php echo !empty($row->additional) ? htmlentities($row->additional) : '-'; ?></td>
                                        <td><?php echo !empty($row->Message) ? htmlentities($row->Message) : '-'; ?></td>
                                        <td><?php echo htmlentities($row->Status); ?></td>
                                        <td>
                                            <a href="process-booking.php?action=approve&id=<?php echo htmlentities($row->BookingID); ?>" class="btn btn-success">Proceed</a>
                                            <a href="process-booking.php?action=decline&id=<?php echo htmlentities($row->BookingID); ?>" class="btn btn-danger">Decline</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="12" class="text-center">No new bookings found.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/core/jquery.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
</body>
</html>

<?php
}
?>
