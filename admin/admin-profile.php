<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $adminid=$_SESSION['odmsaid'];
    $AName=$_POST['adminname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where ID=:aid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
$query->execute();

        echo '<script>alert("Profile has been updated")</script>';
     

  }
  ?>
<!doctype html>
 <html lang="en" class="no-focus">
    <head>
    <title>PVSC Admin | Profile</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    <body>
        <?php include_once('includes/header.php'); ?>

            <main id="main-container">
                <div class="content">
                    <h2 class="content-heading">Admin Profile</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block block-themed">
                                <div class="block-content">
                                    <?php

$sql="SELECT * from  tbladmin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <form method="post">
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-username">Admin Name:</label>
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="adminname" value="<?php  echo $row->AdminName;?>" required='true'>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-email">User Name:</label>
                                            <div class="col-12">
                                                 <input type="text" class="form-control" name="username" value="<?php  echo $row->UserName;?>" readonly="true">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12" for="register1-password">Email:</label>
                                            <div class="col-12">
                                                <input type="email" class="form-control" name="email" value="<?php  echo $row->Email;?>" required='true'>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-12" for="register1-password">Contact Number:</label>
                                            <div class="col-12">
                                                 <input type="text" class="form-control" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>" required='true' maxlength='10'>
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label class="col-12" for="register1-password">Admin Registration Date:</label>
                                            <div class="col-12">
                                                 <input type="text" class="form-control" id="email2" name="" value="<?php  echo $row->AdminRegdate;?>" readonly="true">
                                            </div>
                                        </div>
                                      <?php $cnt=$cnt+1;}} ?>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-alt-success" name="submit">
                                                    <i class="fa fa-plus mr-5"></i> Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        
                       </div>
                </div>
            </main>

          <?php include_once('includes/footer.php');?>
        </div>
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>
    </body>
</html>
<?php }  ?>