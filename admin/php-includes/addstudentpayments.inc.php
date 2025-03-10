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
            Add Student Payments
            <small>You can add daily students payments details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">Add Student Payments</li>
          </ol>
        </section>

        <!-- Main content Add Payments -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student Payments</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

             <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Student Payments</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


<?php
 if (isset($_POST['txt_sa_student_id'])) {
        $varStuiD = $_POST['txt_sa_student_id'];

?>
     <div class="col-md-3">

         <?php
                             //This will show the Student Details
                    $stmt7 = $db->prepare("SELECT stu_studentID, stu_studentname, stu_image_name FROM cp_students LEFT JOIN `cp_subj_allo` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_students.stu_studentID LIKE '%{$varStuiD}%' OR cp_subj_allo.sa_barCode LIKE '%{$varStuiD}%' LIMIT 1");
                    $stmt7->bind_result($Student_ID, $stu_studentname, $imageNames);
                    $stmt7->execute();




         ?>
                <div class="form-group">
                <img class="profile-user-img img-responsive img-bordered" style="width:300px;height:300px; margin-bottom: 50px" src="Upload/studentphotos/<?php  while ($stmt7->fetch()) { echo $imageNames; }  ?>"> 
              <h3 class="profile-username text-center"><?php echo $stu_studentname; ?></h3>

                <?php

                     //This will show the Student Details
                    $stmt9 = $db->prepare("SELECT cp_subj_allo.sa_batch_no, cp_subj_allo.sa_stu_student_id FROM `cp_subj_allo` LEFT JOIN `cp_students` ON cp_subj_allo.sa_stu_student_id = cp_students.stu_studentID WHERE cp_subj_allo.sa_stu_student_id LIKE '%{$varStuiD}%' OR cp_subj_allo.sa_barCode LIKE '%{$varStuiD}%' LIMIT 1");
                    $stmt9->bind_result($sa_batch_no, $sa_stu_student_id);
                    $stmt9->execute();


                ?>
                <h4 class="profile-username text-center">Student ID: <?php  while ($stmt9->fetch()){ echo $sa_stu_student_id; } ?></h4>
                </div>
      </div>





    <h4><b>Courses Allocated</b></h4>
             <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-bordered">

                    <thead bgcolor="#3c8dbc" style="color: white;" >
                      <tr>
                        <th >Course Name</th>
                        <th >Batch No</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody bgcolor="#3c8dbc" style="color: white;" >

                        <?php

                    //This will show the Student Atten Details
                    $stmt6 = $db->prepare("SELECT cp_subjects.subj_name, cp_students.stu_barcode, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_subj_id FROM `cp_subj_allo` INNER JOIN `cp_subjects` ON cp_subj_allo.sa_subj_id = cp_subjects.subj_id INNER JOIN `cp_students` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_subj_allo.sa_stu_student_id LIKE '%{$varStuiD}%' OR cp_subj_allo.sa_barCode LIKE '%{$varStuiD}%'");
                    $stmt6->bind_result($subj_name, $stu_barcode, $sa_batch_no, $sa_subj_id);
                    $stmt6->execute();

                    while ($stmt6->fetch()){
                        
                                                       
                    //To generate payment ID
                    $ReceiptNo =  rand();
                             

                        ?>

                      <tr>

                      <td style="font-size: 20px; font-weight: bold;"><?php echo $subj_name; ?></td>
                      <td style="font-size: 20px; font-weight: bold;"><?php echo $sa_batch_no; ?></td>
                      <td>
                    

                      <a  style="margin-top: 10px;"  id="addNewpay" href="index.php?page=AddPayment&StudentID=<?php echo $Student_ID; ?>&StudentName=<?php echo $stu_studentname; ?>&SubjID=<?php echo $sa_subj_id; ?>&SubjName=<?php echo $subj_name; ?>&ReceiptNo=<?php echo $ReceiptNo; ?>&BatchID=<?php echo $sa_batch_no; ?>" target="_blank"  class="btn btn-success btn-flat btn-lg">Add Payment</a>                
                      <a style="margin-top: 10px;" target="_blank" href="index.php?page=StudentAttendance&StudentID=<?php echo $_POST['txt_sa_student_id']; ?>" class="btn btn-warning btn-lg">Mark Attendance</a>

                      
                      
                      </td>


                      </tr>

                   <?php

                  }

                   ?>

                    </tbody>

                  </table>
                </div>




              <br><br><br><br>
            <hr  style="margin-top: 200px;">

            <form id="form_addstudent1" role="form" action="<?php  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                    <div class="form-group">
                      <label>Student ID | Barcode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>
                           <input type="number" name="txt_sa_student_id" class="form-control" id="stu_id" required>
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
                        $(function() {
                                $(document).on("keypress", function() {
                                  $("#stu_id").focus();
                                });

                                $("#stu_id").on("keyup", function() {
                                  if($(this).val().length == 8) {
                                    $("#form_addstudent1").submit();
                                  }
                                });
                              });

                    </script>




           <div class="box-footer">

                <div style="margin-bottom: 10px;"class= "col-lg-6 col-md-12 col-xs-1">
                <input style="margin-bottom: 10px;" class="btn  btn-success" type="submit" name="btn_Attendance" value="Search Student">

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
                      <input type="text" value="<?php echo date('Y-m-d'); ?>" name="txt_pay_endate" class="form-control" readonly>
                    </div>


                    </div>

                    <div class="form-group">
                      <label>Student ID | Barcode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>
                           <input type="number" name="txt_sa_student_id" class="form-control" required autofocus>
                       </div>
                    </div>


           <div class="box-footer">

                <div style="margin-bottom: 10px;"class= "col-lg-6 col-md-12 col-xs-1">
                <input style="margin-bottom: 10px;" class="btn  btn-success" type="submit" name="btn_Add_Payment" value="Search Student">
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
