<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

//Check the total students to limite the entry...
$limiteStudents = $db->prepare("SELECT count(stu_ID) FROM cp_students");
$limiteStudents->bind_result($rowcount);
$limiteStudents->execute();

while ($limiteStudents->fetch()){

 }
                
// Select the user and assign permission...        
$stmt1111 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1111" ); 
$stmt1111->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1111->execute();

while ($stmt1111->fetch()){ 
    
}

            
//linked with addstudent.fn.php
$ADDSTUDENT = addstudent();


?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
<?php
    if ($cp_userpermission_OnOff == 0){
        
// If the User not accssign the permission the access will be denied...
//        $Message = "<p class='text-center'>";
//        $Message .= "<img src='Upload/ad.png'>";
            $Message .= "<h1>Access Denied</h1>";
//        $Message .= "Access Denied";
//        $Message .= "</p>";
        echo $Message;
        
    } else {
            
            
            ?>
          <h1>
            Add Student
            <small>You can add students details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">Add Student</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a Student</h3>
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

                    <form id="form_addstudent" name="form_add_student" style="<?php //echo $addStyle; ?>" role="form" action="<?php $ADDSTUDENT;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    <div style="display: none;" class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    
                    <?php
                    
                        if(isset($_GET['StudentID'])){
                            
                                $AutoNuber = $_GET['StudentID'];
                            
                        } else {

                                $a = mt_rand(100000,1000000); 
                                $AutoNuber = $a + 159357; 
                        }

                    ?>
                    
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" name="txt_student_id" value="<?php echo $AutoNuber; ?>" class="form-control ">
                       </div>
                    </div>

                     <div class="form-group">
                         <label>Upload Student Photo</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                               
                           <?php
                           
                           if ($_GET['im'] == 1){
                               $im = 'df.jpg';
                           } else {
                               $im = $_GET['StudentPhoto'];
                           }
                            
                           
                           ?>
                           <input type="file" name="txt_student_Photo"  class="form-control"  id="file" />
                           <input type="hidden" id="hid_student_Photo" name="hid_student_Photo" value="<?php echo $im; ?>">
<!--                       <textarea class="form-control" name="txt_student_Photo" rows="1"></textarea></div>
                            <button style=" margin-top: 10px;" type="button" class="btn btn-info" onclick="javascript:void window.open('https://postimages.org/','1473862735520','width=700,height=965,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;" >Upload Student Photo</button>-->

                    </div>
                    
                  <div class="form-group">
                    <label>Registration Date* (M:D:Y)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" name="txt_regDate" value="<?php echo $_GET['RegistrationDate']; ?>" class="form-control pull-right" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                     <div class="form-group">
                          <label>Student Name*</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" name="txt_student_name" value="<?php echo $_GET['StudentName']; ?>" class="form-control" required>
                       </div>

                    </div>
                  
                                    
                    <div class="form-group">
                      <label>Address</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                      <textarea class="form-control"  name="txt_student_address" rows="3"><?php echo $_GET['Address']; ?></textarea>
                       </div>
                    </div>
                    
                    
              
                    <div class="form-group">
                      <label>Sex</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-venus-mars"></i>
                      </div>                       
                      <select name="txt_student_sex" class="form-control">
                        <option><?php echo $_GET['Sex']; ?></option>  
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      </div>
                    </div>
                  
                  <div class="form-group">
                    <label>Birth Date (Y:M:D)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <?php
                            if ($Bday = ""){
                                $Bday = "0000-00-00";
                            } else {
                                $Bday = $_GET['BirthDate'];
                            }
                        ?>
                        <input type="text" name="txt_BDate" value="<?php echo $Bday; ?>" class="form-control pull-right">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->                
                                      
                     <div class="form-group">
                    <label>Home Phone Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                        <input type="text" value="<?php echo $_GET['HomePhoneNumber']; ?>" class="form-control" name="txt_student_hmphone">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->               
                  
                  
                  <div class="form-group">
                    <label>Mobile Number 01*</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile"></i>
                      </div>
                        <input type="text" value="<?php echo $_GET['MobileNumber01']; ?>" name="txt_student_Mno01" class="form-control" required>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>Mobile Number 02</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-mobile "></i>
                      </div>
                      <input type="text" class="form-control" value="<?php echo $_GET['MobileNumber02']; ?>" name="txt_student_Mnub02">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                      </div>
                        <input type="email" value="<?php echo $_GET['Email']; ?>" name="txt_student_email" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
 
                   <div class="form-group">
                    <label>NIC | ID Number</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                      </div>
                        <input type="text" name="txt_student_nic" value="<?php echo $_GET['NIC']; ?>"  class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  <div class="form-group">
                    <label>School</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-university"></i>
                      </div>
                        <input type="text" name="txt_student_school" value="<?php echo $_GET['School']; ?>" class="form-control" >
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                  
                   <div class="form-group">
                      <label>Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_student_notes" rows="4"></textarea>
                      </div>
                   </div>

                  <?php
                  
                  if(isset($_GET['Accesskey'])){
                      $b = $_GET['Accesskey'];
                  } else {
                      $b = mt_rand(10000,100000);
                  }
                  
                   
                  ?>
                  <div class="form-group">
                    <label>Access Key</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                      </div>
                        <input type="text" value="<?php echo $b; ?>" name="txt_student_accesskey" class="form-control" readonly>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <hr>
                  
                     <div style="display: none;" class="form-group">
                      <label>Allocation ID</label>
                      <input type="text" name="txt_AlloAutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                                   
                    <?php
                    
                                //This will show the subject ID
                                $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
                                $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
                                $stmt5->execute();

                                
                                
                   
                    
                    ?>
                  
                    <div class="form-group">
                      <label>Course | Subject Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa  fa-book"></i>
                      </div>                       
                      <select name="txt_subject" class="form-control">
                      
                          <?php
                               
                              while ($stmt5->fetch()){

                           ?>
                          
                        <option><?php echo $AS_Subj_ID . " ". $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                              
                        
                        ?>
                       
             </select>         
                  </div>
                    </div>

 
                  <?php
                                //This will show institutes
                                $stmtIns = $db->prepare("SELECT ins_id, ins_name FROM `cp_ins`");
                                $stmtIns->bind_result($ins_ID, $ins_Name);
                                $stmtIns->execute();                  
                  ?>
                  <div style="display: none;" class="form-group">
                      <label>Branch</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>                       

                      <select name="txt_Institue_id" class="form-control">
                      
                          <?php
                               
                              while ($stmtIns->fetch()){

                           ?>
                          
                          <option value="<?php echo $ins_ID; ?>"><?php echo $ins_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                              
                        
                        ?>
                       
                      </select>
                      </div>
                    </div>
                  
                  
                    <div class="form-group">
                      <label>Special Course | Subject Fee</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-usd"></i>
                        </div>                       
                      <input type="text" name="txt_subject_fee" class="form-control">
                       </div>
                    </div>
                  
                    <div class="form-group">
                        <label>Batch No* Ex: COA-2021 | ICTOL-2021</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-cubes"></i>
                        </div>                       
                           <input type="text" name="txt_batch_no" class="form-control" required>
                       </div>
                    </div>
                  
                   <div class="form-group">
                      <label>Allocation Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_allocation_notes" rows="4"></textarea>
                      </div>
                   </div>
                  
                    <div class="form-group">
                      <label>BarCode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_barcode" rows="1"></textarea>                       
                       </div>
                    </div>              
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" name="btn_AddStu_submit" type="submit" onclick="" value="Register this Student [F2]">                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New">
                <a style="margin-top: 5px;" href="index.php?page=ViewAllStudents" class="btn  btn-danger">View All Students </a>
               
                </div>
            
<script>
   
//If Javascript to run the Keypress
$(function(){
    //Yes! use keydown 'cus some keys is fired only in this trigger,
    //such arrows keys
    $("body").keydown(function(e){
         //now we caught the key code, yabadabadoo!!
         var keyCode = e.keyCode || e.which;

            if ((e.which || e.keyCode) == 113) {
                
                    //well you need keep on mind that your browser use some keys 
                    //to call some function, so we'll prevent this
                    e.preventDefault();
                    
                    //Triger the submit form after press the key
                    document.form_add_student.submit();   
                        
                        //Window will reload after sumit
                        window.onload = function() {
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                     };
        }
         //your keyCode contains the key code, F1 to F12 
         //is among 112 and 123. Just it.
         console.log(keyCode); //You can see the ouput log on browser console  
    });
});


</script>         


            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
<?php   

 }  

$db->close();

?>        
      </div><!-- /.content-wrapper -->

 <?php

 
   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

 ?>