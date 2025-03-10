<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../php-includes/connect.inc.php'; 


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Mark Student Absents</title>

    <!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Sweet Alert Class-->
<script src="../plugins/sweetalert/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../plugins/sweetalert/sweetalert.css">


  </head>
  <body>


  <div class="container">
  <div class="row col-md-8">


   <h1>Make Student Absents </h1>


   <form action="" method="post">
  <div class="form-group ">
    <label for="autorank">Absent Date</label>
    <input type="text" class="form-control" id="autorank" name="abs_date" value="<?php echo $_GET['Date']; ?>" placeholder="" readonly>
  </div>

  <div class="form-group">
    <label for="act_B_R">Subject ID</label>
    <input type="text" class="form-control" value="<?php echo $_GET['SubjectID']; ?>" name="abs_subjid" id="act_B_R" placeholder="Enter Actual Bath Rank Hare"  readonly>
  </div>

  <div class="form-group">
    <label for="act_B_R">Student ID</label>
    <input type="text" class="form-control" value="<?php echo $_GET['StudentID']; ?>" name="abs_stuid" id="act_B_R" placeholder="Enter Actual Bath Rank Hare"  readonly>
  </div>


       <button type="submit" name="abs_submit" class="btn btn-success">Make Student Absent</button>
  <a style="" href="#" onclick="window.top.close();" class="btn btn-primary" >Close</a>
</form>



  </div>
</div>



 <?php




  if (isset($_POST['abs_submit'])) {


    $AB_date =  $_POST['abs_date'];
    $AB_stuID =  $_POST['abs_stuid'];
    $AB_subjID =  $_POST['abs_subjid'];


    global $db;


       //Used a prepared statment to add annousments to the database..)
    $stmt = $db->prepare("INSERT INTO `cp_absent` (date, student_id, subj_id) VALUES (?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('sii', $AB_date, $AB_stuID, $AB_subjID);
    $stmt->execute();
    $stmt->close();



             //echo "<script>sweetAlert('Success', 'Actual Batch Rank Updated', 'success');</script>";

             //echo "<script>swal({   title: 'Success',   text: 'Absent Marked.',   timer: 2000,   showConfirmButton: false }); </script>";

             //Auto refresh the page when the window close...
             echo "<script> window.top.close(); </script>";


    }



    ?>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>



<?php


// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}



?>
