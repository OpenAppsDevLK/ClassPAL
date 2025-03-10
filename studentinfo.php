<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['Stu_id'])){




?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Information </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav" style="background-color: #ab200f;">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container" style="margin-left:50px;">
            <div class="navbar-header">
              <a class="navbar-brand">Student Information</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <!--<form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form>-->
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->

    <?php

//We will get the studentID from GET request, to find the values in database, and display that values on the forms...

//includes Files
require_once 'admin/php-includes/connect.inc.php';

if(isset($_GET['StudentID'])){
 $StudentID = $_GET['StudentID'];



  $stmt_get_student = $db->prepare("SELECT stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_sex, stu_bday, stu_image_name FROM `cp_students` WHERE stu_studentID= $StudentID") ;
  $stmt_get_student->bind_result($varID, $varStudentID, $varStuRegDate, $varStuName, $varStuSex, $varStuBDay, $UploadName);
  $stmt_get_student->execute();




  while ($stmt_get_student->fetch()){


      $varID = htmlentities($varID, ENT_QUOTES, "UTF-8");
      $varStudentID = htmlentities($varStudentID, ENT_QUOTES, "UTF-8");
      $varStuRegDate = htmlentities($varStuRegDate, ENT_QUOTES, "UTF-8");
      $varStuName = htmlentities($varStuName, ENT_QUOTES, "UTF-8");
      $varStuSex = htmlentities($varStuSex, ENT_QUOTES, "UTF-8");
      $varStuBDay = htmlentities($varStuBDay, ENT_QUOTES, "UTF-8");
      





  }






?>

            <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <!-- Text here -->
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="admin/Upload/studentphotos/<?php echo $UploadName; ?>" alt="User profile picture"  style="width:403px;height:385px; border-radius: 10px;">
                  <h3 class="profile-username text-center"><?php echo $varStuName; ?></h3>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Student ID:</b> <a class="pull-right"><?php echo $varStudentID; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Gender:</b> <a class="pull-right"><?php echo $varStuSex; ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Registration Date:</b> <a class="pull-right"><?php echo $varStuRegDate; ?></a>
                    </li>
                  </ul>
                  <a href="logout.php" class="btn btn-primary btn-block"><b>Logout</b></a>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#annousments" data-toggle="tab">Announcements</a></li>
                  <li><a href="#payments" data-toggle="tab">Payments</a></li>
                  <li><a href="#attendence" data-toggle="tab">Attendances</a></li>
                  
                </ul>

<?php
  $stmt_select_announcements = $db->prepare("SELECT id, an_title, an_des, an_date FROM `cp_announcements` ORDER BY an_date DESC") ;
  $stmt_select_announcements->bind_result($varAN_id, $varAN_title, $varAN_des, $varAN_date);
  $stmt_select_announcements->execute();




?>
                <div class="tab-content">
                  <div class="active tab-pane" id="annousments">
                    <!-- Post -->

 <?php
   while ($stmt_select_announcements->fetch()){

      $varAN_title = htmlentities($varAN_title, ENT_QUOTES, "UTF-8");
      $varAN_des = htmlentities($varAN_des, ENT_QUOTES, "UTF-8");
      $varAN_date = htmlentities($varAN_date, ENT_QUOTES, "UTF-8");




 ?>
                    <div class="post">
                      <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="admin/Upload/annous.png" alt="user image">
                        <span class='username'>
                          <a href="#"><?php echo $varAN_title;  ?></a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                        <span class='description'>Date: <?php echo $varAN_date; ?></span>
                      </div><!-- /.user-block -->
                      <p style="padding-left: 50px;">
                          <?php echo $varAN_des; ?>
                      </p>
                    </div><!-- /.post -->
<?php
 }
?>
</div><!-- /.tab-pane -->

         <div class="tab-pane table-responsive no-padding" id="payments">
   <table id="vas_table2" class="table table-hover table-bordered table-responsive">


                    <thead>
                      <tr>
                        <th>Pay ID</th>
                        <th>Subject Name</th>
                        <th>Pay Date</th>
                        <th>Paid Month</th>
                        <th>Fee [Rs.]</th>
                        <th>Admission [Rs.]</th>
                        <th>Total [Rs.]</th>
                        <th>Misc. Payment Des.</th>
                        <th>Misc. Payment Amt.</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
 $StudentID2 = $_GET['StudentID'];

$stmt_get_payments = $db->prepare("SELECT cp_payments.pay_id, cp_payments.Pay_stu_studentID, cp_payments.pay_student_name, cp_payments.pay_subj_id, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_fee, cp_payments.pay_cos_admi, cp_payments.pay_cos_total, cp_payments.pay_misc_pay_description, cp_payments.pay_misc_amount, cp_subjects.subj_id, cp_subjects.subj_name FROM cp_payments INNER JOIN cp_subjects ON cp_payments.pay_subj_id = cp_subjects.subj_id WHERE Pay_stu_studentID LIKE '%{$StudentID2}%' ORDER BY pay_paymentdate DESC") ;
$stmt_get_payments->bind_result($varpay_id, $varPay_stu_studentID, $varpay_student_name, $varpay_subj_id, $varpay_paymentdate, $varpay_paymentmonth, $varpay_cos_fee, $varpay_cos_admi, $varpay_cos_total, $varPay_pay_misc_pay_description, $varPay_pay_misc_amount, $Varsubj_id, $Var_Subj_Name);
$stmt_get_payments->execute();

while ($stmt_get_payments->fetch()){

      $varpay_id = htmlentities($varpay_id, ENT_QUOTES, "UTF-8");
      $varPay_stu_studentID = htmlentities($varPay_stu_studentID, ENT_QUOTES, "UTF-8");
      $varpay_student_name = htmlentities($varpay_student_name, ENT_QUOTES, "UTF-8");
      $varpay_subj_id = htmlentities($varpay_subj_id, ENT_QUOTES, "UTF-8");
      $varpay_paymentdate = htmlentities($varpay_paymentdate, ENT_QUOTES, "UTF-8");
      $varpay_paymentmonth = htmlentities($varpay_paymentmonth, ENT_QUOTES, "UTF-8");
      $varpay_cos_fee = htmlentities($varpay_cos_fee, ENT_QUOTES, "UTF-8");
      $varpay_cos_admi = htmlentities($varpay_cos_admi, ENT_QUOTES, "UTF-8");
      $varpay_cos_total = htmlentities($varpay_cos_total, ENT_QUOTES, "UTF-8");
      
      $varPay_pay_misc_pay_description = htmlentities($varPay_pay_misc_pay_description, ENT_QUOTES, "UTF-8");
      $varPay_pay_misc_amount = htmlentities($varPay_pay_misc_amount, ENT_QUOTES, "UTF-8");
      
      $Varsubj_id = htmlentities($Varsubj_id, ENT_QUOTES, "UTF-8");
      $Var_Subj_Name = htmlentities($Var_Subj_Name, ENT_QUOTES, "UTF-8");




?>


                      <tr>

                         <td><?php echo $varpay_id;  ?></td>
                         <td><?php echo $Var_Subj_Name;  ?></td>
                         <td><?php  echo $varpay_paymentdate; ?></td>
                         <td><?php echo $varpay_paymentmonth;  ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php  echo $varpay_cos_fee; ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php echo $varpay_cos_admi;  ?></td>
                         <td style="text-align: center; font-weight: bolder;"><?php echo $varpay_cos_total;  ?></td>
                         <td><?php  echo $varPay_pay_misc_pay_description; ?></td>
                         <td><?php echo $varPay_pay_misc_amount;  ?></td>


                      </tr>
<?php
}
?>

                   </tbody>

                     <tfoot>
                      <tr>
                        <th>Pay ID</th>
                        <th>Subject Name</th>
                        <th>Pay Date</th>
                        <th>Paid Month</th>
                        <th>Fee [Rs.]</th>
                        <th>Admission [Rs.]</th>
                        <th>Total [Rs.]</th>
                        <th>Misc. Payment Des.</th>
                        <th>Misc. Payment Amt.</th>

                      </tr>

                    </tfoot>
                  </table>


                  </div><!-- /.tab-pane -->

         <div class="tab-pane table-responsive no-padding" id="attendence">
                     <hr>
                     <h5><b>Student Attendance</b></h5>
                      <hr>
                      <table id="vas_table2" class="table table-hover table-bordered table-responsive">


                    <thead>
                      <tr>
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                        <th>Course | Class Name</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
 $StudentID3 = $_GET['StudentID'];

$stmt_get_atten = $db->prepare("SELECT cp_attendance.id, cp_attendance.date, cp_attendance.student_id, cp_attendance.subj_id, cp_attendance.att_time, cp_subjects.subj_name FROM `cp_attendance` INNER JOIN `cp_subjects` ON cp_attendance.subj_id = cp_subjects.subj_id WHERE cp_attendance.student_id = $StudentID3  ORDER BY cp_attendance.date DESC") ;
$stmt_get_atten->bind_result($VarATid, $VarATdate, $VarATstudent_id, $VarATsubj_id, $VarATatt_time, $VarATSubj_name );
$stmt_get_atten->execute();

while ($stmt_get_atten->fetch()){

      $VarATid = htmlentities($VarATid, ENT_QUOTES, "UTF-8");
      $VarATdate = htmlentities($VarATdate, ENT_QUOTES, "UTF-8");
      $VarATstudent_id = htmlentities($VarATstudent_id, ENT_QUOTES, "UTF-8");
      $VarATsubj_id = htmlentities($VarATsubj_id, ENT_QUOTES, "UTF-8");
      $VarATatt_time = htmlentities($VarATatt_time, ENT_QUOTES, "UTF-8");
      $VarATSubj_name = htmlentities($VarATSubj_name, ENT_QUOTES, "UTF-8");


?>


                      <tr>

                         <td><?php echo $VarATdate;  ?></td>
                         <td><input type="time"  value="<?php echo $VarATatt_time;  ?>" class="form-control" disabled></td>
                         <td><?php  echo $VarATSubj_name; ?></td>


                      </tr>
<?php
}
?>

                   </tbody>

                     <tfoot>
                      <tr>
                        <th>Attendance Date</th>
                        <th>Attendance Time</th>
                        <th>Course | Class Name</th>


                      </tr>

                    </tfoot>
                  </table>

                     <br>
                     <hr>
                     <h5><b>Student Absent</b></h5>
                     <hr>
                   <table id="vas_table2" class="table table-hover table-bordered table-responsive">


                    <thead>
                      <tr>
                        <th>Absent Date</th>
                        <th>Course | Class Name</th>
                      </tr>
                    </thead>
                    <tbody>

<?php
 $StudentID5 = $_GET['StudentID'];

$stmt_get_ab = $db->prepare("SELECT cp_absent.id, cp_absent.date, cp_absent.student_id, cp_absent.subj_id, cp_subjects.subj_name FROM `cp_absent` INNER JOIN `cp_subjects` ON cp_absent.subj_id = cp_subjects.subj_id WHERE cp_absent.student_id = $StudentID5  ORDER BY cp_absent.date DESC") ;
$stmt_get_ab->bind_result($VarATid, $VarATdate, $VarATstudent_id, $VarATsubj_id, $VarATSubj_name );
$stmt_get_ab->execute();

while ($stmt_get_ab->fetch()){

      $VarATid = htmlentities($VarATid, ENT_QUOTES, "UTF-8");
      $VarATdate = htmlentities($VarATdate, ENT_QUOTES, "UTF-8");
      $VarATstudent_id = htmlentities($VarATstudent_id, ENT_QUOTES, "UTF-8");
      $VarATsubj_id = htmlentities($VarATsubj_id, ENT_QUOTES, "UTF-8");
      $VarATSubj_name = htmlentities($VarATSubj_name, ENT_QUOTES, "UTF-8");


?>


                      <tr>

                         <td><?php echo $VarATdate;  ?></td>
                         <td><?php  echo $VarATSubj_name; ?></td>


                      </tr>
<?php
}
?>

                   </tbody>

                     <tfoot>
                      <tr>
                        <th>Absent Date</th>
                        <th>Course | Class Name</th>


                      </tr>

                    </tfoot>
                  </table>

                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
<?php
$stmt_get_student->close();
$stmt_select_announcements->close();
$stmt_get_payments->close();
$stmt_get_atten->close();
} else {
    echo "Error: No input Parameter";
}
?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
          </div>
            <strong>Copyright &copy;<?php echo date('Y'); ?> ClassPAL by DilMAX .</strong> All rights reserved.
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>

<?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: login123.php');
}


?>
