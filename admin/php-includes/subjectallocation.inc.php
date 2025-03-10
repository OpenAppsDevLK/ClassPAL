<?php


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1117 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1117" ); 
$stmt1117->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1117->execute();

while ($stmt1117->fetch()){ 
    
}


//linked with subjectallocation.fn.php
$SUBJECTALLOCATION = subjectallocation();


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
            Course | Subject Allocation
            <small>You can add students to course | Subject form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">courses | Subject</a></li>
            <li class="active">Course Allocation</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Allocate a Student</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Student Allocation Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="<?php $SUBJECTALLOCATION;  ?>" method="post" enctype="multipart/form-data" >
                  
                  <!-- Subject Allocation -->
                  <div style="display: none;" class="form-group">
                      <label>Allocation ID</label>
                      <input type="text" name="txt_AlloAutoID" class="form-control" placeholder="AUTO" readonly>
                    </div>  
                  
                  
         
                  
                   <?php
                    
                                //This will show the student
                                $stmt6 = $db->prepare("SELECT stu_studentID, stu_studentname FROM `cp_students`");
                                $stmt6->bind_result($SA_Stu_ID, $SA_Stu_Name);
                                $stmt6->execute();

                    
                    ?>
                  <div class="form-group">
                      <label>Student Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa  fa-book"></i>
                      </div>                       
                    <select name="txt_stu_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      
                        <option><?php echo $_GET['StudentID'] . " ". $_GET['StudentName']; ?></option>
                        <?php
                               
                              while ($stmt6->fetch()){

                           ?>
                          
                        <option><?php echo $SA_Stu_ID . " ". $SA_Stu_Name; ?></option>
                        
                        <?php
                              }
                        ?>
                        

                    </select>
                  
                      </div>
                  </div>
             
                   <?php
                    
                                //This will show the student
                                $stmt7 = $db->prepare("SELECT stu_studentID, stu_studentname FROM `cp_students`");
                                $stmt7->bind_result($SA_Stu_ID, $SA_Stu_Name);
                                $stmt7->execute();

                    
                    ?>
                  
                  <div class="form-group">
                      <label>Student Name (Retype to Confirm)</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa  fa-book"></i>
                      </div>                       
                    <select name="txt_stu_name" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      
                        <option><?php echo $_GET['StudentName']; ?></option>
                        <?php
                               
                              while ($stmt7->fetch()){

                           ?>
                          
                        <option><?php echo $SA_Stu_Name; ?></option>
                        
                        <?php
                              }
                        ?>
                        

                    </select>
                  
                      </div>
                  </div>
                  
                    <div class="form-group">
                      <label>BarCode</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_student_barcode" rows="1"></textarea>                       </div>
                    </div>    
                  
                  
                    <?php
                    
                                //This will show the student ID
                                $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
                                $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
                                $stmt5->execute();

                                
                                
                   
                    
                    ?>
                  
                    <div class="form-group">
                      <label>Courses | Subject</label>
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

                  
                  
                    <div class="form-group">
                        <label>Batch No*</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-cubes"></i>
                        </div>                       
                           <input type="text" name="txt_batch_no" class="form-control" required>
                       </div>
                    </div>

                    <div class="form-group">
                      <label>Special Fee</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-usd"></i>
                        </div>                       
                      <input type="text" name="txt_subject_fee" class="form-control">
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


                  
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" value="Add Now">                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New">
                <a style="margin-top: 5px;" href="index.php?page=SubNPay" class="btn  btn-danger">View All Courses | Subjects </a>
                
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
     <?php   
     
     
           }  
            // Close your database connection and Other Connections...
            $db->close();
//                $stmt6->close();
//                $stmt7->close();
//                $stmt5->close();

                              
      ?>    
      </div><!-- /.content-wrapper -->

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

      
?>
