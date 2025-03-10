<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

//// Select the user and assign permission...        
//$stmt1123 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1123" ); 
//$stmt1123->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
//$stmt1123->execute();
//
//while ($stmt1123->fetch()){ 
//    
//}

//linked with changebnumber.fn.php
$CHANGECOUR_ID = Change_C_ID();


?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
//    if ($cp_userpermission_OnOff == 0){
//
//        //$Message = "<p class=''>";
//        //$Message .= "<img src='Upload/ad.png'>";
//        $Message .= "<h1>Access Denied</h1>";
//        //$Message .= "</p>";
//        echo $Message;
//        
//    } else {
            
            
?>               
            
          <h1>
            Course Converter
            <small>You can change students course form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Courses and Payments</a></li>
            <li><a href="#">View Students</a></li>
            <li class="active">C:Converter</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Course Number Converter</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Course Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="<?php $CHANGEBNUMB;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                   
              <?php
             
             $SearchKey =  $_GET["SearchKey"];
             $SubjectID = $_GET["SubjectID"];
             ?>                   
                    <div class="form-group">
                      <label>Old Batch Number</label>
                      <input type="text" name="txt_BC_OldBNub" value="<?php echo $SearchKey; ?>" class="form-control"  readonly required>
                    </div>
                    
                    <div class="form-group">
                      <label>Courses ID</label>
                      <input type="text" name="txt_BC_SubjID" value="<?php echo $SubjectID; ?>" class="form-control"  readonly required>
                    </div>
<!--                    <div class="form-group">
                      <label>New Course ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </div>                       
                           <input type="text" name="txt_BC_NewBNo" value="" class="form-control"  required>
                       </div>
                    </div>-->
        <?php
   
            //This will show the Subjects
            $stmt_select_course_name = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt_select_course_name->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt_select_course_name->execute();


         ?>                    
                    <div class="form-group">
                      <label>Course Name</label>
                      <select style="margin-bottom: 5px;" name="txt_BC_NewBNo" class="form-control" required>
                      
                          <?php
                               
                              while ($stmt_select_course_name->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>                     
   
                    </div>
                     
           
           
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                 <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#changeMsg">Convert Now</button>                
                <a style="margin-top: 5px;" href="index.php?page=SubNPay&PageNo=1" class="btn  btn-success">View All Courses </a>
                
                </div>
            
 <!-- Modal Window for Delete User-->
<div class="modal fade modal-danger" id="changeMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Convert Course ID</h4>
      </div>
      <div class="modal-body">
          Do you really want to convert to this course... ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
        <input  style="" class="btn  btn-success btn-flat" type="submit" onclick="" name="btn_submitBC" value="Converte Now">
      </div>
    </div>
  </div>
</div>
 
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
         <?php  // }  ?>  
      </div><!-- /.content-wrapper -->

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

?>