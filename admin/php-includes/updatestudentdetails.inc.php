<?php


//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);



// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1114 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1114" ); 
$stmt1114->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1114->execute();

while ($stmt1114->fetch()){ 
    
}


//linked with updatestudentdetils.fn.php
$UPDSTESTUDENT = upadtestudent();


?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            
<?php
    if ($cp_userpermission_OnOff == 0){

//        $Message = "<p class='text-center'>";
//        $Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";       
//        $Message .= "Access Denied";
//        $Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>
            
          <h1>
            Update Student Details
            <small>You can update students details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">View All Students</a></li>
            <li class="active">Update Students</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Student</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Student Registration Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="<?php $UPDSTESTUDENT;  ?>" method="post" enctype="multipart/form-data" >
 
                      <?php
 
                      //We will get the studentID from GET request, to find the values in database, and display that values on the forms...

                    if(isset($_GET['StudentID'])){
                       $StudentID = $_GET['StudentID']; 
                       
                     $PNo = $_GET["PageNo"];  
                    
                    //This variable comming from studentreg.fn.php
                    global $UploadName;  
                       
                        $stmt = $db->prepare("SELECT stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_notes, stu_image_name, stu_nic, stu_school, stu_accesskey FROM `cp_students` WHERE stu_studentID= $StudentID") ;
                        $stmt->bind_result($varID, $varStudentID, $varStuRegDate, $varStuName, $varStuAddress, $varStuSex, $varStuBDay, $varStuConHome, $varStuConMob01, $varStuConMob02, $varStuEmail, $varStuNotes, $UploadName, $varStuNIC, $varStuSchool, $stu_accesskey);
                        $stmt->execute();
                    
                        while ($stmt->fetch()){
                            
                            $varID = htmlentities($varID, ENT_QUOTES, "UTF-8");
                            $varStudentID = htmlentities($varStudentID, ENT_QUOTES, "UTF-8");
                            $varStuRegDate = htmlentities($varStuRegDate, ENT_QUOTES, "UTF-8");
                            $varStuName = htmlentities($varStuName, ENT_QUOTES, "UTF-8");
                            $varStuAddress = htmlentities($varStuAddress, ENT_QUOTES, "UTF-8");
                            $varStuSex = htmlentities($varStuSex, ENT_QUOTES, "UTF-8");
                            $varStuConHome = htmlentities($varStuConHome, ENT_QUOTES, "UTF-8");
                            $varStuConMob01 = htmlentities($varStuConMob01, ENT_QUOTES, "UTF-8");
                            $varStuConMob02 = htmlentities($varStuConMob02, ENT_QUOTES, "UTF-8");
                            $varStuEmail = htmlentities($varStuEmail, ENT_QUOTES, "UTF-8");
                            $varStuNotes = htmlentities($varStuNotes, ENT_QUOTES, "UTF-8");
                            $varStuNIC = htmlentities($varStuNIC, ENT_QUOTES, "UTF-8");
                            $varStuSchool = htmlentities($varStuSchool, ENT_QUOTES, "UTF-8");
                            $stu_accesskey = htmlentities($stu_accesskey, ENT_QUOTES, "UTF-8");
                            
                            
                            
                        }
                    
                    
                    
                    }
                    
                    
                    ?>
                          
  <div class="row">                    
      <div class="col-md-3">                  
                <div class="form-group">
                    <img  src="Upload/studentphotos/<?php echo $UploadName; ?>"  class="img-responsive " id="Uploadimg" name="Uploadimg" style=" margin: 0; width:403px;height:385px; border-radius: 10px;">
                           <h4 class=""><?php echo $varStuName; ?> | <?php echo $varStudentID; ?></h4> 
                       
                           
                </div> 
      </div>                

 <div class="col-md-8"> 

     
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Student Payments
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
          
    <?php
      //To generate payment ID
      $ReceiptNo =  rand();
   ?> 
          
   <div class="box-body table-responsive no-padding">
                  
                  
                   <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                    <thead>
                      <tr>
                        <th>Pay ID</th>
                        <th>Subject Name</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Amount</th>
                        

                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $Student_ID = $_GET['StudentID'];


                        $stmt = $db->prepare("SELECT cp_payments.pay_id, cp_payments.pay_subj_id, cp_subjects.subj_name, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_total  FROM `cp_payments` LEFT JOIN `cp_subjects` ON cp_subjects.subj_id = cp_payments.pay_subj_id  WHERE cp_payments.Pay_stu_studentID=$Student_ID ORDER By cp_payments.pay_paymentdate DESC  LIMIT 5") ;
                        $stmt->bind_result($pay_id, $pay_subj_id, $pay_subj_Name, $pay_paymentdate, $pay_paymentmonth, $pay_cos_total);
                        $stmt->execute();

                        while ($stmt->fetch()){
  
  
      
                
                        ?>
                    
                        
                      <tr>
                        
                         <td><?php echo $pay_id;  ?></td>
                         <td><?php echo $pay_subj_Name; ?></td>
                         <td><?php echo $pay_paymentdate;  ?></td>
                         <td><?php echo $pay_paymentmonth;  ?></td>
                         <td>Rs. <?php echo $pay_cos_total;  ?></td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody> 
                  </table> 
               

               
              
               
               
            </div>         
          
          
          
          
      </div>
    </div>
  </div>
    
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Student Attendance
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
          
   <div class="box-body table-responsive no-padding">
                  
                   
                   <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Date</th>
<!--                        <th>Subject Name</th>-->
                        <th>Time</th>
                       
                        

                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $Student_ID2 = $_GET['StudentID'];


                        $stmtAtten = $db->prepare("SELECT cp_attendance.date, cp_attendance.subj_id, cp_subjects.subj_name, cp_attendance.att_time  FROM `cp_attendance` LEFT JOIN `cp_subjects` ON cp_attendance.subj_id =  cp_subjects.subj_id WHERE cp_attendance.student_id = $Student_ID2 ORDER BY cp_attendance.date DESC LIMIT 15") ;
                        $stmtAtten->bind_result($date, $subj_id, $subj_Name, $att_time );
                        $stmtAtten->execute();

                        while ($stmtAtten->fetch()){
  
  
      
                
                        ?>
                    
                        
                      <tr>
                        
                         <td><?php echo $date;  ?></td>
<!--                         <td><?php //echo $subj_Name; ?></td>-->
                         <td><?php echo $att_time;  ?></td>
                         

                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody> 
                  </table> 
               

               
              
               
               
            </div>   





      </div>
    </div>
  </div>
    
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingthree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="false" aria-controls="collapsethree">
          Courses | Subject Allocations
        </a>
      </h4>
    </div>
    <div id="collapsethree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
      <div class="panel-body">
          
   <div class="box-body table-responsive no-padding">
                  
                   
                   <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Course Name</th>
                        <th>Course Fee</th>
                       
                        

                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                       $Student_ID3 = $_GET['StudentID'];

                    $stmtCourseAttten = $db->prepare("SELECT cp_students.stu_studentID, cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_subj_id, cp_subj_allo.sa_subj_fee, cp_subjects.subj_id, cp_subjects.subj_name  FROM `cp_students` LEFT JOIN `cp_subj_allo` ON cp_students.stu_studentID =  cp_subj_allo.sa_stu_student_id  JOIN `cp_subjects` ON cp_subjects.subj_id = cp_subj_allo.sa_subj_id  WHERE cp_students.stu_studentID = $Student_ID3 ") ;
                    $stmtCourseAttten->bind_result($stu_studentID, $sa_stu_student_id, $sa_subj_id, $sa_subj_fee, $subj_id, $subj_name);
                    $stmtCourseAttten->execute();
                       
while ($stmtCourseAttten->fetch()){
  
  
      
                
                        ?>
                    
                        
                      <tr>
                        
                         <td><?php echo $subj_name;  ?></td>
                         <td><?php echo $sa_subj_fee; ?></td>
                         

                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody> 
                  </table> 
               

               
              
               
               
            </div>   





      </div>
    </div>
  </div>
</div>


        </div>
      </div>  
                      
                      <!-- text input -->
                      <div style="display: none;" class="form-group">
                      <label>ID</label>
                      <input type="text" value="<?php echo $varID; ?>" name="txt_AutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $varStudentID; ?>" name="txt_student_id"  class="form-control" readonly>
                       </div>
                    </div>
                      
<!--                    <div class="form-group">
                      <label>BarCode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>  
                            <input type="text" value="<?php //echo $stu_barcode; ?>" name="txt_student_barcode"  class="form-control">
                    </div>
                    </div>-->
                      
                      
                      <input style="margin-bottom: 10px;" type="button" class="btn btn-lg  btn-success" value="Click to Add Student Photo" onclick="window.open('Upload/studentphotos/uploadstudentphoto.php?StudentID=<?php echo $_GET['StudentID']; ?>','popUpWindow','height=300,width=800,left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');">   
                      <a class="btn  btn-info" style="" href="index.php?page=UpdateStudentDetails&StudentID=<?php echo $_GET['StudentID']; ?>&PageNo=<?php echo $_GET['PageNo']; ?>">Refresh</a>
                      <br>
                      <button style="" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Remove Photo</button>
               
                     
                  <div class="form-group">
                    <label>Registration Date [Mob:(D:M:Y) | PC:(M:D:Y)]</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" value="<?php echo $varStuRegDate; ?>" name="txt_regDate" class="form-control pull-right ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                     <div class="form-group">
                          <label>Student Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="<?php echo $varStuName; ?>" name="txt_student_name" class="form-control">
                       </div>

                    </div>
                  
                                    
                    <div class="form-group">
                      <label>Address</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                      <textarea class="form-control" name="txt_student_address" rows="3"><?php echo $varStuAddress; ?></textarea>
                       </div>
                    </div>
                    
                    
              
                    <div class="form-group">
                      <label>Sex</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-venus-mars"></i>
                      </div>                       
                      <select name="txt_student_sex" class="form-control">
                        <option><?php echo $varStuSex; ?></option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                    </div>
                  
                  <div class="form-group">
                    <label>Birth Date (M:D:Y)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" value="<?php echo $varStuBDay; ?>" name="txt_BDate" class="form-control pull-right ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group --> 
                  
                                      
                     <div class="form-group">
                    <label>Home Phone Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuConHome; ?>" class="form-control" name="txt_student_hmphone">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->               
                  
                  
                  <div class="form-group">
                    <label>Mobile Number 01</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuConMob01; ?>" name="txt_student_Mno01" class="form-control">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>Mobile Number 02</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile "></i>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $varStuConMob02; ?>" name="txt_student_Mnub02">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                        <input type="email" value="<?php echo $varStuEmail; ?>" name="txt_student_email" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                 
                   <div class="form-group">
                      <label>Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_student_notes" rows="4"><?php echo $varStuNotes; ?></textarea>
                      </div>
                   </div>
                  

                   <div class="form-group">
                    <label>NIC | ID Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuNIC; ?>" name="txt_student_nic" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>School</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-university"></i>
                      </div>
                        <input type="text" value="<?php echo $varStuSchool; ?>" name="txt_student_school" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
 
                  <div class="form-group">
                    <label>Access Key</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                        <input type="text" value="<?php echo $stu_accesskey; ?>" name="txt_student_accesskey" class="form-control">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
           <div class="box-footer">
              
               <?php
               
               if(isset($_GET["SearchKey"])){
                   $LINK = "index.php?page=ViewAllStudents&SearchKey={$_GET['SearchKey']}";
                   $ButText = "Go Back to Search";
               }  else {
                   $LINK = "index.php?page=ViewAllStudents&PageNo=$PNo";
                   $ButText = "View All Students";
               }
               
               ?>
                <div class= "col-lg-6 col-md-12 col-xs-1">
                    <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" name="submit_student_update" onclick="" value="Update this Student">
                <a style="margin-top: 5px;" href="<?php echo $LINK; ?>" class="btn  btn-primary"><?php echo $ButText; ?> </a>
                </div>
            

               
               
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            
<!-- Delete Image Model Window--> 
<!-- Modal -->
<div class="modal fade modal-danger" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove Student Photo</h4>
      </div>
      <div class="modal-body">
          Do you want to delete <b><?php echo $varStuName; ?>'s </b> photo ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
        <a  href="actions/deletestuimage.php?txt-uploadename=<?php echo $UploadName ?>&StudentID=<?php echo $StudentID ?>&page=UpdateStudentDetails&PageNo=<?php echo $PNo ?>" class='btn btn-success btn-flat'>Yes</a>
      </div>
    </div>
  </div>
</div>            

          </div><!-- /.box -->

        </section><!-- /.content -->
         <?php   
         
               }  
         ?> 
      </div><!-- /.content-wrapper -->

       <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

      
      ?>