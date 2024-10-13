<?php
session_start();
include('includes/dbconnection.php');

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    // Determine the new status based on the action
    if ($action == 'approve') {
        $status = 'Approved';
    } elseif ($action == 'decline') {
        $status = 'Declined';
    } else {
        header('location:bookings.php'); // Redirect if action is invalid
        exit;
    }

    // Update the booking status in the database
    $sql = "UPDATE tblbooking SET Status = :status WHERE BookingID = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    
    if ($query->execute()) {
        header('location:bookings.php'); // Redirect to the bookings page after the action
    } else {
        echo "Error updating status.";
    }
} else {
    header('location:bookings.php'); // Redirect if parameters are missing
}
?>
