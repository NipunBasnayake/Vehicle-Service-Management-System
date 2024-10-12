<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['obbsuid']) == 0) {
    header('location:logout.php');
    exit();
}

if (isset($_POST['submit'])) {
    $bid = $_GET['bookid'];
    $uid = $_SESSION['obbsuid'];
    $bookingfrom = $_POST['bookingfrom'];
    $bookingto = $_POST['bookingto'];
    $eventtype = $_POST['eventtype'];
    $nop = $_POST['nop'];
    $message = $_POST['message'];
    $stateid = $_POST['state'];
    $cityname = $_POST['city-list'];
    $bookingid = mt_rand(100000000, 999999999);

    // Insert query
    $sql = "INSERT INTO tblbooking (BookingID, ServiceID, UserID, BookingFrom, BookingTo, EventType, Numberofguest, Message, stateId, cityName)
            VALUES (:bookingid, :bid, :uid, :bookingfrom, :bookingto, :eventtype, :nop, :message, :stateid, :cityname)";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':bookingfrom', $bookingfrom, PDO::PARAM_STR);
    $query->bindParam(':bookingto', $bookingto, PDO::PARAM_STR);
    $query->bindParam(':eventtype', $eventtype, PDO::PARAM_STR);
    $query->bindParam(':nop', $nop, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':stateid', $stateid, PDO::PARAM_STR);
    $query->bindParam(':cityname', $cityname, PDO::PARAM_STR);

    // Execute and check the insertion
    if ($query->execute()) {
        echo '<script>alert("Your Booking Request Has Been Sent. We Will Contact You Soon.")</script>';
        echo "<script>window.location.href ='services.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
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

    <!-- Fetch cities based on selected state -->
    <script>
        function getcities(val) {
            $.ajax({
                type: "POST",
                url: "get_city.php",
                data: 'state_id=' + val,
                success: function (data) {
                    $("#city-list").html(data);
                }
            });
        }
    </script>
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="backgroundImg">
        <div class="bookingdiv">
            <h1>Book Services</h1>
            <div class="bookingformdiv">
                <form method="post" id="bookingForm">
                    <input type="date" class="form-controlbo" name="bookingfrom" required>
                    <input type="date" class="form-controlbo" name="bookingto" required>

                    <select class="form-controlbo" name="eventtype" required>
                        <option value="">Choose Event Type</option>
                        <?php
                        $sql2 = "SELECT * FROM tbleventtype";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result2 as $row) { ?>
                            <option value="<?php echo htmlentities($row->EventType); ?>">
                                <?php echo htmlentities($row->EventType); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <input type="number" class="form-controlbo" name="nop" placeholder="Number of Guests" min="1" required>
                    <textarea class="form-controlbo" name="message" placeholder="Message (optional)"></textarea>

                    <select class="form-controlbo" name="state" onChange="getcities(this.value);" required>
                        <option value="">Select State</option>
                        <?php
                        $sql3 = "SELECT * FROM tblstate";
                        $query3 = $dbh->prepare($sql3);
                        $query3->execute();
                        $result3 = $query3->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result3 as $row) { ?>
                            <option value="<?php echo htmlentities($row->ID); ?>">
                                <?php echo htmlentities($row->StateName); ?>
                            </option>
                        <?php } ?>
                    </select>

                    <select class="form-controlbo" name="city-list" id="city-list" required>
                        <option value="">Select City</option>
                    </select>

                    <div class="button-container">
                        <button type="submit" name="submit" class="btn-submit">Submit</button>
                        <button type="reset" class="btn-clear" onclick="clearForm()">Clear All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to clear the form and show alert
        function clearForm() {
            document.getElementById('bookingForm').reset();
            alert('Form has been cleared!');
        }
    </script>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
