<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../php-includes/connect.inc.php';  

    $Subj_ID = $_GET['SubjectID'];
    $date01 = $_GET['date01'];
    $date02 = $_GET['date02'];




?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Students Attendances</title>
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
        
        <?php
    
            //This will show the student ID
            $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects` WHERE subj_id = $Subj_ID");
            $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt5->execute();
            
             while ($stmt5->fetch()){
                  
                 

              } 
              
        ?>
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-users"></i> Report: Students Attendances <br> Course Name: <?php echo $AS_Sunj_Name; ?> <br> From <?php echo $date01; ?> To <?php echo $date02; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <?php
       
        //This will show the Student details
        $stmt = $db->prepare("SELECT cp_attendance.id,cp_attendance.student_id, cp_attendance.date, cp_attendance.att_time, cp_students.stu_studentID, cp_students.stu_studentname  FROM `cp_attendance` INNER JOIN `cp_students` ON cp_attendance.student_id=cp_students.stu_studentID WHERE cp_attendance.date BETWEEN '$date01' AND '$date02' AND cp_attendance.subj_id = $Subj_ID ORDER BY cp_attendance.date DESC");
        $stmt->bind_result($cp_attendance_id, $cp_attendance_student_id, $cp_attendance_date, $cp_attendance_att_time, $cp_students_stu_studentID, $cp_students_tu_studentname);
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
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $cp_attendance_student_id; ?></td>
                        <td><?php echo $cp_students_tu_studentname;  ?></td>
                        <td><?php echo $cp_attendance_date; ?></td>
                        <td><?php echo $cp_attendance_att_time; ?></td>

                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
              <?php

//               $stmt1 = $db->prepare("SELECT COUNT(cp_attendance.id) FROM `cp_attendance` INNER JOIN `cp_students` ON cp_attendance.student_id=cp_students.stu_studentID WHERE cp_attendance.date BETWEEN '$date01' AND '$date02' AND cp_attendance.subj_id = $Subj_ID ");
//               $stmt1->bind_result($TotalStudents);
//               $stmt1->execute();
//
//               while ($stmt1->fetch()){
//                 
//                   
//            }

            ?>
                    
<!--                    <th>Total Students: <?php // echo $TotalStudents; ?></th>-->
                  
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row --        
        
        
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

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