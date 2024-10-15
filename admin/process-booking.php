<?php
session_start();
include('includes/dbconnection.php');

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == 'approve') {
        $status = 'Approved';
    } elseif ($action == 'decline') {
        $status = 'Declined';
    } else {
        header('location:new-booking.php');
        exit;
    }

    $sql = "UPDATE tblbooking SET Status = :status WHERE BookingID = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    
    if ($query->execute()) {
        header('location:new-booking.php');
    } else {
        echo "Error updating status.";
    }
} else {
    header('location:new-booking.php');
}
?>
