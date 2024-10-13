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
        <div class="logindiv">
            <h1>Booking Services</h1>
            <br>
            <div class="form-body">
                <form action="">
                    <input type="date" class="form-input" name="bookingfrom" required="true" placeholder="Date">
                    <input type="date" class="form-input" name="bookingto" required="true" placeholder="Time">

                    <select type="text" class="form-input" id="formselect" name="eventtype" required="true" >
						<option value="">Choose Event Type</option>
						<?php 
                            $sql2 = "SELECT * from   tbleventtype ";
                            $query2 = $dbh -> prepare($sql2);
                            $query2->execute();
                            $result2=$query2->fetchAll(PDO::FETCH_OBJ);
                            foreach($result2 as $row)
                            {          
                        ?>  
                        <option value="<?php echo htmlentities($row->EventType);?>"><?php echo htmlentities($row->EventType);?></option>
                        <?php } ?>
					</select>
                    <input type="number" class="form-input" name="nop" placeholder="Num ber of Guests" min="1" required="true" placeholder="Full Name">
                    <textarea class="form-input" name="message" placeholder= "Message (optional)"></textarea>

                    <button class="btn-submit" name="signup">Clear All</button>
                    <button class="btn-submit" name="signup">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function clearForm() {
            document.getElementById('bookingForm').reset();
            alert('Form has been cleared!');
        }
    </script>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>
