<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$odmsaid=$_SESSION['odmsaid'];
 $pagetitle=$_POST['pagetitle'];
$pagedes=$_POST['pagedes'];
$sql="update tblpage set PageTitle=:pagetitle,PageDescription=:pagedes where  PageType='aboutus'";
$query=$dbh->prepare($sql);
$query->bindParam(':pagetitle',$pagetitle,PDO::PARAM_STR);
$query->bindParam(':pagedes',$pagedes,PDO::PARAM_STR);

$query->execute();
echo '<script>alert("About us has been updated")</script>';


  }
  ?>


<!doctype html>
 <html lang="en" class="no-focus">

<head>
    <title>PVSC Admin | About Us</title>
    <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <main id="main-container">
        <div class="content">
            <h2 class="content-heading">Update About Us</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="block block-themed">
                        <div class="block-content">
                            <form method="post">
                                <?php
                                    $sql="SELECT * from  tblpage where PageType='aboutus'";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $row)
                                    {?>        
                                <div class="form-group row">

                                <label class="col-12" for="register1-email">Page Title:</label>
                                <div class="col-12">
                                    <input type="text" name="pagetitle" value="<?php  echo $row->PageTitle;?>" class="form-control" required='true'>
                                </div>
                            </div>
                        <div class="form-group row">
                        <label class="col-12" for="register1-email">Page Description:</label>
                            <div class="col-12">
                                <textarea type="text" name="pagedes" class="form-control" required='true'><?php  echo $row->PageDescription;?></textarea>
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