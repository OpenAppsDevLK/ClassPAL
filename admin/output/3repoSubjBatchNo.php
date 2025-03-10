<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../php-includes/connect.inc.php';  

if (isset($_GET['SubjectID'])) {
     $Subj_ID = $_GET['SubjectID'];
     
     $BatchNo = $_GET['SearchKey'];
    
?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Batch Students</title>
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
              
              <?php
              
              
             //This will show the student ID
            $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects` WHERE subj_id = $Subj_ID");
            $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt5->execute();
            
             while ($stmt5->fetch()){
                  
                 

              }  
              
              ?>
              
            <h2 class="page-header">
              <i class="fa fa-users"></i> Report: Batch Students | Course Name: 
              <?php 
              
              echo $AS_Sunj_Name;
              
              ?> | Batch : <?php echo $BatchNo; ?>
              
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php

   
     $SearchKey = $_GET['SearchKey'];
     
    //This will show the Student details
    $stmt = $db->prepare("SELECT cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_stu_student_Name, cp_subj_allo.sa_subj_id, cp_subj_allo.sa_subj_fee, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_notes, cp_students.stu_address, cp_students.stu_school, cp_students.stu_con_mobile1 FROM `cp_subj_allo` INNER JOIN `cp_students` ON  cp_subj_allo.sa_stu_student_id = cp_students.stu_studentID WHERE (sa_batch_no LIKE '%{$SearchKey}%') AND sa_subj_id = $Subj_ID ORDER BY sa_stu_student_id ASC");
    $stmt->bind_result($sa_stu_student_id, $sa_stu_student_Name, $sa_subj_id, $sa_subj_fee, $sa_batch_no, $sa_notes, $StuAddress, $StuSchool, $MobileNo1);
    $stmt->execute();
        
        
        ?>
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Address</th>
<!--                        <th>School Name</th>
                        <th>Batch No</th>-->
                        <th>Contact No</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $sa_stu_student_id; ?></td>
                        <td><?php echo $sa_stu_student_Name;  ?></td>
                        <td><?php echo $StuAddress; ?></td>
<!--                        <td><?php //echo $StuSchool; ?></td>
                        <td><?php //echo $sa_batch_no; ?></td>-->
                        <td><?php echo $MobileNo1; ?></td>
                         
                      

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
<!--                        <th>School Name</th>
                        <th>Batch No</th>-->
                        <th>Contact No</th>
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

               $stmt1 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo WHERE (sa_batch_no LIKE '%{$SearchKey}%') AND sa_subj_id = $Subj_ID");
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