<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


include_once '../php-includes/connect.inc.php';  



?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Detail Report</title>
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
              <i class="fa fa-users"></i> Report: Student Detail Report
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
<?php

    $Student_ID2 = $_GET['StudentID'];

    $stmt2 = $db->prepare("SELECT stu_studentname, stu_image_name FROM `cp_students` WHERE stu_studentID = $Student_ID2");
    $stmt2->bind_result($stu_studentname2, $stu_image_name);
    $stmt2->execute();
    
     while ($stmt2->fetch()){
         
     }
?>
        <!-- Table row -->
        <div class="row">
            
          <div class="col-xs-12 table-responsive">
              
              
              <img  src="../Upload/studentphotos/<?php echo $stu_image_name; ?>"  class="img-responsive " id="Uploadimg" name="Uploadimg" style=" margin: 0; width:200px;height:200px; border-radius: 10px;">
              <h3>Student Name: <?php echo $stu_studentname2; ?></h3>
              
              <h4><b>General Details</b></h4>
              <hr>
            <table id="vas_table" class="table table-hover table-bordered table-responsive">
                
<?php
        $Student_ID = $_GET['StudentID'];

    //This will show the Student details
    $stmt = $db->prepare("SELECT stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_notes, stu_nic, stu_school, stu_accesskey FROM `cp_students` WHERE stu_studentID = $Student_ID");
    $stmt->bind_result($stu_studentID, $stu_regdate, $stu_studentname, $stu_address, $stu_sex, $stu_bday, $stu_con_home, $stu_con_mobile1, $stu_con_mobile2, $stu_email, $stu_notes, $stu_nic, $stu_school, $stu_accesskey);
    $stmt->execute();

?>
                    <?php
                     while ($stmt->fetch()){
                    ?>
                
                    <thead>
                      <tr>
                        <td>Student ID</td>
                        <td><?php echo $stu_studentID; ?></td>
                       </tr> 
                       
                       <tr>
                        <td>Registered Date</td>
                        <td><?php echo $stu_regdate;  ?></td>
                       </tr> 
                       
                       <tr>
                        <td>Student Name</td>
                        <td><?php echo $stu_studentname;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Address</td>
                        <td><?php echo $stu_address;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Sex</td>
                        <td><?php echo $stu_sex;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Birth Day</td>
                        <td><?php echo $stu_bday;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Phone: Home</td>
                        <td><?php echo $stu_con_home;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Mobile No 01</td>
                        <td><?php echo $stu_con_mobile1;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Mobile No 02</td>
                        <td><?php echo $stu_con_mobile2;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Email</td>
                        <td><?php echo $stu_email;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>NIC</td>
                        <td><?php echo $stu_nic;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>School Name</td>
                        <td><?php echo $stu_school;  ?></td>
                        </tr>
                        
                        <tr>
                        <td>Access Key</td>
                        <td><?php echo $stu_accesskey;  ?></td>
                        
                       </tr>
                       
                       <tr>
                        <td>Notes</td>
                        <td><?php echo $stu_notes;  ?></td>
                      </tr>
                    </thead>
                    <tbody>



                        
                        


                      
                   </tbody>
                  
                     
                  </table> 
              
                    <?php
                     }  
                   
                   ?>
              
          </div><!-- /.col -->
        </div><!-- /.row -->
 
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
 <!------Payment Details----------------------------------------------------->       
        <div class="row">      

          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">
              <h4><b>Payment Details</b></h4>
              <hr>        
<?php
 $StudentID3 = $_GET['StudentID']; 
 
$stmt3 = $db->prepare("SELECT cp_payments.pay_id, cp_payments.Pay_stu_studentID, cp_payments.pay_student_name, cp_payments.pay_subj_id, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_fee, cp_payments.pay_cos_admi, cp_payments.pay_cos_total, cp_subjects.subj_id, cp_subjects.subj_name FROM cp_payments INNER JOIN cp_subjects ON cp_payments.pay_subj_id = cp_subjects.subj_id WHERE Pay_stu_studentID LIKE '%{$StudentID3}%' ORDER BY pay_paymentdate DESC") ;
$stmt3->bind_result($varpay_id, $varPay_stu_studentID, $varpay_student_name, $varpay_subj_id, $varpay_paymentdate, $varpay_paymentmonth, $varpay_cos_fee, $varpay_cos_admi, $varpay_cos_total, $Varsubj_id, $Var_Subj_Name);
$stmt3->execute();

?>
                   <thead>
                        <tr>
                        <th>Pay ID</th>
                        <th>Course Name</th>
                        <th>Pay Date</th>
                        <th>Pay Month</th>
                        <th>Fee [Rs.]</th>
                        <th>Admission [Rs.]</th>
                        <th>Total [Rs.]</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt3->fetch()){
                    ?>
                        
                        
                      <tr>

                         <td><?php echo $varpay_id;  ?></td>
                         <td><?php echo $Var_Subj_Name;  ?></td>
                         <td><?php  echo $varpay_paymentdate; ?></td>
                         <td><?php echo $varpay_paymentmonth;  ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php  echo $varpay_cos_fee; ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php echo $varpay_cos_admi;  ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php echo $varpay_cos_total;  ?></td>
                         
                      

                      </tr>
                      
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>      
                  </table> 
               
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        
<!------Attendance Details----------------------------------------------------->       
        <div class="row">      

          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">
              <h4><b>Attendance Details</b></h4>
              <hr>        
<?php
 $StudentID4 = $_GET['StudentID']; 
 
$stmt4 = $db->prepare("SELECT cp_attendance.id, cp_attendance.date, cp_attendance.student_id, cp_attendance.subj_id, cp_attendance.att_time, cp_subjects.subj_name FROM `cp_attendance` INNER JOIN `cp_subjects` ON cp_attendance.subj_id = cp_subjects.subj_id WHERE cp_attendance.student_id = $StudentID4  ORDER BY cp_attendance.date DESC") ;
$stmt4->bind_result($VarATid, $VarATdate, $VarATstudent_id, $VarATsubj_id, $VarATatt_time, $VarATSubj_name );
$stmt4->execute();

?>
                   <thead>
                      <tr>
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                        <th>Class Name</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt4->fetch()){
                    ?>
                        
                        
                      <tr>

                         <td><?php echo $VarATdate;  ?></td>
                         <td><input type="time"  value="<?php echo $VarATatt_time;  ?>" class="form-control"></td>
                         <td><?php  echo $VarATSubj_name; ?></td>
                      

                      </tr>
                      
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>      
                  </table> 
               
              
          </div><!-- /.col -->
        </div><!-- /.row -->

<!------Absents Details----------------------------------------------------->       
        <div class="row">      

          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">
              <h4><b>Absent Details</b></h4>
              <hr>        
<?php
 $StudentID6 = $_GET['StudentID']; 
 
$stmt6 = $db->prepare("SELECT cp_absent.id, cp_absent.date, cp_absent.student_id, cp_absent.subj_id, cp_subjects.subj_name FROM `cp_absent` INNER JOIN `cp_subjects` ON cp_absent.subj_id = cp_subjects.subj_id WHERE cp_absent.student_id = $StudentID6  ORDER BY cp_absent.date DESC") ;
$stmt6->bind_result($VarATid, $VarATdate, $VarATstudent_id, $VarATsubj_id, $VarATSubj_name );
$stmt6->execute();

?>
                   <thead>
                      <tr>
                        <th>Absent Date</th>
                        <th>Class Name</th>
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt6->fetch()){
                    ?>
                        
                        
                      <tr>

                         <td><?php echo $VarATdate;  ?></td>
                         <td><?php  echo $VarATSubj_name; ?></td>
                      

                      </tr>
                      
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>      
                  </table> 
               
              
          </div><!-- /.col -->
        </div><!-- /.row -->        
     
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