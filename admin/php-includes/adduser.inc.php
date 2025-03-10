<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
                
// Select the user and assign permission...        
$stmt1123 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1123" ); 
$stmt1123->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1123->execute();

while ($stmt1123->fetch()){ 
    
}

//linked with addstudent.fn.php
$ADDUSER = adduser();


?>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
    if ($cp_userpermission_OnOff == 0){

        //$Message = "<p class=''>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?> 

               
            
          <h1>
            Add User
            <small>You can add users to the system form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Add User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add a User</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">User Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    <form id="form_addstudent" role="form" action="<?php $ADDUSER;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    <?php
                    
                    $RNuber = rand(1000,10000);
                    
                    ?>
                    
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AU_AutoID" value="<?php echo $RNuber; ?>" class="form-control"  readonly>
                    </div>

                    <div class="form-group">
                      <label>User Name</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                        </div>                       
                           <input type="text" name="txt_AU_username" value="" class="form-control" required>
                       </div>
                    </div>

                     <div class="form-group">
                          <label>Password</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>
                            <input type="password" name="txt_AU_pass" class="form-control" required>
                       </div>

                    </div>
                    
                    <div class="form-group">
                      <label>First Name</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                           <input type="text" name="txt_AU_Fname" value="" class="form-control" required>
                       </div>
                    </div>

                     <div class="form-group">
                          <label>Last Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" name="txt_AU_LName" class="form-control" required>
                       </div>

                    </div>
   
           
           
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" name="btn_submit" value="Add User">                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New">
                <a style="margin-top: 5px;" href="index.php?page=ViewAllUsers&PageNo=1" class="btn  btn-danger">View All Users </a>
                
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