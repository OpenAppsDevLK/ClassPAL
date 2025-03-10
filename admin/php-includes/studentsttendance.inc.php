<?php



// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...
$stmt1116 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1116" );
$stmt1116->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1116->execute();

while ($stmt1116->fetch()){

}



//Link with studentattendance.fn.php
$ADDATTENDANCE = addattendance();


?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

<?php
    if ($cp_userpermission_OnOff == 0){

        //$Message = "<p class='text-center'>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "Access Denied";
        //$Message .= "</p>";
        echo $Message;

    } else {


?>
          <h1>
            Student Attendance
            <small>You can mark daily students attendance details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">Student Attendance</li>
          </ol>
        </section>

        <!-- Main content Add attendance -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student Attendance</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

             <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Mark Student Attendance</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


<?php
 if (isset($_POST['txt_sa_student_barcode'])) {
        $varStu_barcode = $_POST['txt_sa_student_barcode'];

?>
     <div class="col-md-3">

         <?php
                             //This will show the Student Details
//                    $stmt7 = $db->prepare("SELECT stu_studentID, stu_studentname, stu_image_name FROM `cp_students` WHERE stu_studentID LIKE '%{$varStuiD}%' OR stu_barcode LIKE '%{$varStuiD}%' LIMIT 1");
//                    $stmt7->bind_result($Student_ID, $stu_studentname, $imageNames);
//                    $stmt7->execute();

                    //This will show the Student Details
                    $stmt7 = $db->prepare("SELECT stu_studentID, stu_studentname, stu_image_name FROM cp_students LEFT JOIN `cp_subj_allo` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_subj_allo.sa_barCode LIKE '%{$varStu_barcode}%' LIMIT 1");
                    $stmt7->bind_result($Student_ID, $stu_studentname, $imageNames);
                    $stmt7->execute();


         ?>
                <div class="form-group">
                <img class="profile-user-img img-responsive img-bordered" style="width:300px;height:300px; margin-bottom: 50px" src="Upload/studentphotos/<?php  while ($stmt7->fetch()) { echo $imageNames; }  ?>"> 
              

                <?php

                     //This will show the Student Details
                    $stmt9 = $db->prepare("SELECT cp_subj_allo.sa_batch_no, cp_subj_allo.sa_stu_student_id, cp_students.stu_studentname FROM `cp_subj_allo` LEFT JOIN `cp_students` ON cp_subj_allo.sa_stu_student_id = cp_students.stu_studentID WHERE cp_subj_allo.sa_barCode LIKE '%{$varStu_barcode}%' LIMIT 1");
                    $stmt9->bind_result($sa_batch_no, $sa_stu_student_id, $stu_studentname01);
                    $stmt9->execute();
                    
                    

                ?>
                <h4 class="profile-username text-center">Batch No: <?php  while ($stmt9->fetch()){ echo $sa_batch_no.'| ID: '.$sa_stu_student_id .$stu_studentname01; } ?></h4>
                </div>
      </div>





    <h4><b>Student Attendance</b></h4>
             <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-bordered">

                    <thead bgcolor="#3c8dbc" style="color: white;" >
                      <tr>
                        <th >Attend Date</th>
                        <th>Attend Time</th>
                      </tr>
                    </thead>
                    <tbody bgcolor="#3c8dbc" style="color: white;" >

                        <?php

                    //This will show the Student Atten Details
                    $stmt6 = $db->prepare("SELECT cp_attendance.date, cp_attendance.student_id, cp_attendance.att_time FROM `cp_attendance` LEFT JOIN `cp_subj_allo` ON cp_attendance.student_id = cp_subj_allo.sa_stu_student_id WHERE cp_subj_allo.sa_barCode LIKE '%{$varStu_barcode}%' ORDER BY cp_attendance.date DESC LIMIT 2");
                    $stmt6->bind_result($Stu_Att_Date, $Stu_Att_ID, $Stu_Att_time);
                    $stmt6->execute();

                    while ($stmt6->fetch()){



                        ?>

                      <tr>

                      <td><?php echo $Stu_Att_Date; ?></td>
                      <td><?php echo $Stu_Att_time; ?></td>


                      </tr>

                   <?php

                 }

                   ?>

                    </tbody>

                  </table>
                </div>


    <h4><b>Student Payments</b></h4>
             <div class="box-body table-responsive no-padding">
                 <table id="vas_table" class="table table-bordered" >

                    <thead style="color: white;" bgcolor="#00a313">
                      <tr>
                        <th>Paid Date</th>
                        <th>Paid Month</th>
                        <th>Paid Amount</th>
                      </tr>
                    </thead>
                    <tbody bgcolor="#00a313" style="color: white;" >

                        <?php
                        $SubjID_sp = $_GET['SubjID'];

                    //This will show the Student Atten Details
                    $stmt10_payments = $db->prepare("SELECT cp_payments.Pay_stu_studentID, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_total FROM `cp_payments` LEFT JOIN `cp_subj_allo` ON cp_payments.Pay_stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_subj_allo.sa_barCode = $varStu_barcode ORDER BY cp_payments.pay_paymentmonth DESC LIMIT 3");
                    $stmt10_payments->bind_result($Pay_stu_studentID, $pay_paymentdate, $pay_paymentmonth, $pay_cos_total);
                    $stmt10_payments->execute();

                    while ($stmt10_payments->fetch()){

                        $PaidMonth = date('Ym');

                        //if student paid for the current month, table row highlight with red, if not blue...
                        if ($PaidMonth == $pay_paymentmonth){

                            $bg_color = "#D73E2C";

                        } else {
                            $bg_color = "#00a313";
                        }

                        ?>

                      <tr>

                      <td><?php echo $pay_paymentdate; ?></td>
                      <td bgcolor="<?php echo $bg_color; ?>" style="color: floralwhite;"><?php echo $pay_paymentmonth; ?></td>
                      <td><?php echo $pay_cos_total; ?></td>
                      </tr>

                   <?php

                  }

                   ?>

                    </tbody>
                  </table>

                               <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>


<?php
//This will show the institute Details
$stmt_ins_details = $db->prepare("SELECT cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_institutid, cp_ins.ins_name FROM `cp_subj_allo` INNER JOIN `cp_ins` ON  cp_subj_allo.sa_institutid = cp_ins.ins_id WHERE cp_subj_allo.sa_barCode LIKE '%{$varStu_barcode}%'");
$stmt_ins_details->bind_result( $sa_stu_student_id, $sa_institutid, $ins_name);
$stmt_ins_details->execute();
?>

                </div>

                                 <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>

             <script>
<?php
////This will show the institute Details
//$stmt_ins_details_keypress = $db->prepare("SELECT cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_institutid, cp_subj_allo.sa_subj_id, cp_ins.ins_name FROM `cp_subj_allo` INNER JOIN `cp_ins` ON  cp_subj_allo.sa_institutid = cp_ins.ins_id WHERE cp_subj_allo.sa_stu_student_id LIKE '%{$varStuiD}%'");
//$stmt_ins_details_keypress->bind_result( $sa_stu_student_id, $sa_institutid, $sa_subj_id, $ins_name);
//$stmt_ins_details_keypress->execute();
?>

                    // Open Add Payment Window Shift + P
//                    $(document).keypress(function(e) {
//                        if(e.which == 80) {
//                            window.open('index.php?page=AddPayment&StudentID=<?php //echo $Student_ID; ?>&StudentName=<?php //echo $stu_studentname; ?>&SubjID=<?php //echo $sa_subj_id; ?>&SubjName=<?php //echo $_GET['SubjName']; ?>&ReceiptNo=<?php //echo $ReceiptNo; ?>&InsName=<?php  //while ($stmt_ins_details_keypress->fetch()){ echo $ins_name; } ?>','_blank');
//                        }
//                    });
              </script>

                                        <hr  style="margin-top: 100px;">

            <form id="form_addstudent1" role="form" action="<?php  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                    <div class="form-group">
                      <label>Student Barcode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>
                           <input style="font-size: 30px; font-weight: bold;" type="text"  name="txt_sa_student_barcode" class="form-control" id="stu_id" autofocus required>
                       </div>
                    </div>


                    <div class="form-group">
                      <input type="text" name="txt_attenID" class="form-control" placeholder="AUTO" readonly>
                    </div>

                    <div class="form-group">
                      <label>Date</label>
                      <input type="text" value="<?php echo date('Y-m-d'); ?>" name="txt_attendate" class="form-control" readonly>
                    </div>


                    </div>

                    <script>
                        //Auto focus to Student ID field
//                        $(function() {
//                                $(document).on("keypress", function() {
//                                  $("#stu_id").focus();
//                                });
//
//                                $("#stu_id").on("keyup", function() {
//                                  if($(this).val().length == 8) {
//                                    $("#form_addstudent1").submit();
//                                  }
//                                });
//                              });

                    </script>




           <div class="box-footer">

                <div style="margin-bottom: 10px;"class= "col-lg-6 col-md-12 col-xs-1">
                <input style="margin-bottom: 10px;" class="btn  btn-success" type="submit" name="btn_Attendance_01" value="Add to Attendance">
                <a style="margin-bottom: 10px;" href="index.php?page=ViewAllAttendance" class="btn  btn-warning">View All Student Attendance</a>

                </div>

            </div><!-- /.box-footer-->

            </form>

        </div><!-- /.content-wrapper -->

                    </div><!-- /.box-body -->


          </div><!-- /.box -->
        </div>
      </div>


<?php
 } else {


?>
      <hr>

                  <form id="form_addstudent" role="form" action="<?php  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->


                    <div style="display: none;" class="form-group" >
                      <label>ID</label>
                      <input type="text" name="txt_attenID" class="form-control" placeholder="AUTO" readonly>
                    </div>

                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" value="<?php echo date('Y-m-d'); ?>" name="txt_attendate" class="form-control">
                    </div>


                    </div>
                    
                    <?php
                        
                        if(isset($_GET[StudentID])){
                            $studentID = $_GET[StudentID];
                        }
                    
                    ?>

                    <div class="form-group">
                      <label>Student Barcode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>
                           <input type="number" value="<?php echo $studentID; ?>" name="txt_sa_student_barcode" class="form-control" required autofocus>
                       </div>
                    </div>


           <div class="box-footer">

                <div style="margin-bottom: 10px;"class= "col-lg-6 col-md-12 col-xs-1">
                <input style="margin-bottom: 10px;" class="btn  btn-success" type="submit" name="btn_Attendance" value="Add to Attendance">
                <a style="margin-bottom: 10px;" href="index.php?page=AddAbsents" class="btn  btn-danger">Add Absents </a>
                <a style="margin-bottom: 10px;" href="index.php?page=ViewAllAttendance" class="btn  btn-warning">View All Student Attendance</a>
                </div>

            </div><!-- /.box-footer-->
            </div><!-- /.content-wrapper -->
            </form>
            </div><!-- /.box-body -->


          </div><!-- /.box -->
        </div>
      </div>





     <?php
                    }

}
    ?>


<?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login123.php');
}


?>
