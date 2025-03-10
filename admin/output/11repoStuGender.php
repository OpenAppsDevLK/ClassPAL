<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
include_once '../php-includes/connect.inc.php';  

if (isset($_GET['StudentGender'])) {
     $SchoolGender = $_GET['StudentGender'];
     $BatchNo = $_GET['BatchNo'];

?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Students Gender</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <!-- onload="window.print();" -->
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">

            <h2 class="page-header">
              <i class="fa fa-users"></i> Report: Student Gender | Gender Name: <?php echo $SchoolGender; ?> | Batch No: <?php echo $BatchNo; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

 <?php
 
        //This will show the Student details
       $stmt = $db->prepare("SELECT cp_students.stu_studentID, cp_students.stu_studentname, cp_students.stu_address, cp_students.stu_sex, cp_students.stu_con_mobile1, cp_students.stu_school, cp_subj_allo.sa_batch_no FROM `cp_students` INNER JOIN `cp_subj_allo` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_students.stu_sex LIKE '{$SchoolGender}%' AND cp_subj_allo.sa_batch_no LIKE '{$BatchNo}%' ORDER BY cp_students.stu_studentID ASC");
       $stmt->bind_result($stu_studentID, $stu_studentname, $stu_address, $stu_sex, $stu_con_mobile1, $stu_school, $BatNo);
       $stmt->execute();
 
 ?>
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Address</th>
                        <th>Sex</th>
                        <th>Mobile No</th>
                        <th>School Name</th>
                        <th>Batch No</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $stu_studentID; ?></td>
                        <td><?php echo $stu_studentname;  ?></td>
                        <td><?php echo $stu_address;  ?></td>
                        <td><?php echo $stu_sex; ?></td>
                        <td><?php echo $stu_con_mobile1; ?></td>
                        <td><?php echo $stu_school; ?></td>
                        <td><?php echo $BatNo; ?></td>
                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Address</th>
                        <th>Sex</th>
                        <th>Mobile No</th>
                        <th>School Name</th>
                         <th>Batch No</th>
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
              <?php

               $stmt1 = $db->prepare("SELECT COUNT(cp_students.stu_studentID) FROM cp_students INNER JOIN cp_subj_allo ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_students.stu_sex LIKE '{$SchoolGender}%' AND cp_subj_allo.sa_batch_no LIKE '{$BatchNo}%'");
               $stmt1->bind_result($TotalStudents);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
                    
                    <th>Total Students: <?php echo $TotalStudents; ?></th>
                  
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->
<?php
}
?>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
  </body>
</html>

<?php

// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

?>