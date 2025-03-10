<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...        
$stmt1120 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1120" ); 
$stmt1120->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1120->execute();

while ($stmt1120->fetch()){ 
    
}

//linked with updatesubject.fn.php
$UPDATESUBJECT = updatesubject();


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
            Edit Course Details
            <small>You can update Course details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">Courses &AMP; Payments</a></li>
            <li class="active">Edit Course</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Course</h3>
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
                  <form id="form_addstudent" role="form" action="<?php $UPDATESUBJECT;  ?>" method="post" enctype="multipart/form-data" >
 
                      <?php
 
                      //We will get the studentID from GET request, to find the values in database, and display that values on the forms...

                    if(isset($_GET['SubjectID'])){
                       $SubjectID = $_GET['SubjectID']; 
                       
                     //$PNo = $_GET["PageNo"];  
                    
                       
                        $stmt = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects` WHERE subj_id= $SubjectID") ;
                        $stmt->bind_result($es_var_subjid, $es_var_subjname, $es_var_subjfee );
                        $stmt->execute();
                    
                        while ($stmt->fetch()){
                            
                            $es_var_subjid = htmlentities($es_var_subjid, ENT_QUOTES, "UTF-8");
                            $es_var_subjname = htmlentities($es_var_subjname, ENT_QUOTES, "UTF-8");
                            $es_var_subjfee = htmlentities($es_var_subjfee, ENT_QUOTES, "UTF-8");

                        }

                    }
                    
                    
                    ?>

                    <div class="form-group">
                      <label>Course ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $es_var_subjid; ?>" name="txt_subj_id" value="<?php echo $AS_Student_ID; ?>" class="form-control" readonly>
                       </div>
                    </div>


                     <div class="form-group">
                          <label>Course Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="<?php echo $es_var_subjname; ?>" name="txt_subj_name" class="form-control">
                       </div>

                    </div>
                  
                                    
                     <div class="form-group">
                          <label>Course Fee</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="<?php echo $es_var_subjfee; ?>" name="txt_subj_fee" class="form-control">
                       </div>

                    </div>
                    
                    
     
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" value="Update this Course">
                <a style="margin-top: 5px;" href="index.php?page=SubNPay&PageNo=1" class="btn  btn-primary">View All Course</a>
                </div>
            
               
               
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

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
