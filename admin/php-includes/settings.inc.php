<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...       
$stmt1126 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1135" ); 
$stmt1126->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1126->execute();

while ($stmt1126->fetch()){ 
    
}


//linked with update_enable_disable_setting.fn.php
$update_login_page_settings = Update_enable_disable_settings();

//linked with update_login_page+setting.fn.php
$update_login_page_settings = update_login_page_settings();

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
            Settings
            <small>You can change the useful settings...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tools</a></li>
            <li class="active">Settings</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Settings</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           
           
           <!-- Enable/Disable Student Registration Start -->
           
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Enable/Disable Student Registration on login page</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="E_D_Student_reg" role="form" action="" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                    
<?php

  
    $stmt_select_En_Dis_Stu_Regis_settings = $db->prepare("SELECT setting_id, Enable_Disable_Stu_Reg FROM `cp_settings` WHERE `setting_id`=3 ");
    $stmt_select_En_Dis_Stu_Regis_settings->bind_result($setting_id_ed_sr, $Enable_Disable_Stu_Reg);
    $stmt_select_En_Dis_Stu_Regis_settings->execute();

    
        while ($stmt_select_En_Dis_Stu_Regis_settings->fetch()){ 
        
            if ($Enable_Disable_Stu_Reg === 1){
                
                $ck_en1 = "selected";
                
            } elseif ($Enable_Disable_Stu_Reg === 0) {
            
                $ck_en2 = "selected";
        
                
            };
                
                
        } 
    
        
?>                    
                    
                    <div class="form-group ">
                      <label>Enable or Disable </label>
                       <div class="input-group">
                                        
<!--                           <input type="checkbox" style="width:30px;height:30px;" value="1" name="ck_e_d_reg"  >-->
                            <select name="ck_e_d_reg" class="form-control"> 
                                <option value="1"<?php echo $ck_en1; ?>>Enable</option>
                                <option value="0" <?php echo $ck_en2; ?> >Disable</option>
                             </select>
                           
                       </div>
                    </div>

                    

           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success" type="submit" onclick="" name="btn_e_d_reg" value="Save">                    
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->         
 
            <!-- Enable/Disable Student Registration End --> 
            
            
            
            <!-- Login Page Settings Start -->    
            
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Login Page Settings</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="login_page_settings" role="form" action="" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                    
<?php

  
    $stmt_select_login_page_settings= $db->prepare("SELECT setting_id, 	teacher_name, teacher_photo FROM `cp_settings` WHERE `setting_id`=4 ");
    $stmt_select_login_page_settings->bind_result($setting_id_login_page_st, $teacher_name, $teacher_photo);
    $stmt_select_login_page_settings->execute();

    
        while ($stmt_select_login_page_settings->fetch()){ 
                   
        } 
    
        
?>                    
                    
                    <div class="form-group">
                      <label>Institute Name</label>
                      <input type="text" name="txt_tea_name" value="<?php echo $teacher_name; ?>" class="form-control ">
                      </div>

                    
                    <div class="form-group">
                      <label>Institute Logo</label>
                      <input type="file" name="teacher_photo" class="form-control" id="file" />
                      <input type="hidden" name="uploaded_teacher_photo" value="<?php echo $teacher_photo; ?>" class="form-control">
                    </div>
                    
                    

           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success" type="submit" onclick="" name="btn_login_page_settisngs" value="Save">                    
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->        
          
            <!-- Login Page Settings End -->  
          
        </section><!-- /.content -->
        
        
        
 <?php   
 
                    }  
                    
                // Close your database connection and Other Connections...
//               $stmt1126->close();
//               $stmtAnnouncementID->close();
//               $stmt->close();
               $db->close();
               mysqli_close($db);
 
 ?> 
     
      </div><!-- /.content-wrapper -->
      
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
?>
