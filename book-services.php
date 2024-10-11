<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Redirect if not logged in
if (strlen($_SESSION['obbsuid']) == 0) {
    header('location:logout.php');
} else {
    // Handle form submission
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
        $sql = "INSERT INTO tblbooking 
            (BookingID, ServiceID, UserID, BookingFrom, BookingTo, EventType, Numberofguest, Message, stateId, cityName)
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

        // Execute the query and check for success
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

        // Function to clear the form
        function clearForm() {
            document.getElementById('bookingForm').reset();
        }
    </script>
</head>

<body>
    <!-- Include header -->
    <?php include_once('includes/header.php'); ?>

    <div class="backgroundImg">
        <div class="bookingdiv">
            <h1>Book Services</h1>
            <div class="bookingformdiv">
                <form id="bookingForm" method="post" action="">

                    <!-- Booking From and To -->
                    <label class="formlable">Booking Date</label>
                    <input type="date" class="form-control" name="bookingdate" required>

                    <label class="formlable">Booking Time</label>
                    <input type="time" class="form-control" name="bookingtime" required>

                    <!-- Event Type -->
                    <label class="formlable">Type of Service</label>
                    <select class="form-control" name="eventtype" required>
                        <option value="">Choose a Service</option>
                        <?php
                        $sql2 = "SELECT * FROM tbleventtype";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result2 as $row) { ?>
                            <option value="<?php echo htmlentities($row->EventType); ?>"><?php echo htmlentities($row->EventType); ?></option>
                        <?php } ?>
                    </select>

                    <!-- Number of Guests -->
                    <label class="formlable">Number of Guests</label>
                    <input type="number" class="form-control" name="nop" min="1" required>

                    <!-- State and City Selection -->
                    <label class="formlable">State</label>
                    <select class="form-control" onChange="getcities(this.value);" name="state" id="state" required>
                        <option value="">Choose State</option>
                        <?php
                        $sql3 = "SELECT * FROM states";
                        $query3 = $dbh->prepare($sql3);
                        $query3->execute();
                        $result3 = $query3->fetchAll(PDO::FETCH_OBJ);
                        foreach ($result3 as $row1) { ?>
                            <option value="<?php echo htmlentities($row1->id); ?>"><?php echo htmlentities($row1->state_title); ?></option>
                        <?php } ?>
                    </select>

                    <label class="formlable">City</label>
                    <select class="form-control" name="city-list" id="city-list" required>
                        <option value="">Select City</option>
                    </select>

                    <!-- Message -->
                    <label class="formlable">Message (optional)</label>
                    <textarea class="form-control" name="message" rows="4"></textarea>

                    <!-- Submit and Clear Buttons -->
                    <div class="btndiv">
                        <button type="button" onclick="clearForm()" class="btnClear">Clear</button>
                        <button type="submit" name="submit" class="btnSubmit">Submit</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Include footer -->
    <?php include_once('includes/footer.php'); ?>
</body>

</html>
<?php } ?>
