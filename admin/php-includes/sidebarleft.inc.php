<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

        
// Select the user and assign permission...          
$stmt_select_sp_user = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} " ); 
$stmt_select_sp_user->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt_select_sp_user->execute();

while ($stmt_select_sp_user->fetch()){ 
    
}

?>



    <?php
  
    // If page name is set on URL, Nav bar will forcus on the to the page....
    if(isset($_GET['page'])){
        $setpage = $_GET['page'];
        
        if ($setpage == "AddStudents"){
            $active1 = "active"; 
        }  
           if ($setpage == "ViewAllStudents"){
            $active2 = "active"; 
        }     
       
        if ($setpage == "StudentAttendance"){
            $active3 = "active"; 
        }  
        
        if ($setpage == "CourseAllocation"){
            $active4 = "active"; 
        }
        
        if ($setpage == "SubNPay"){
            $active5 = "active"; 
        }
        
        if ($setpage == "ViewSubjectAllocations"){
            $active6 = "active"; 
        }
       
        if ($setpage == "AddUser"){
            $active7 = "active"; 
        }
        
        if ($setpage == "ViewAllUsers"){
            $active8 = "active"; 
        }   
        
        if ($setpage == "AddAnnouncement"){
            $active9 = "active"; 
        } 
        
        
        if ($setpage == "Notes"){
            $active10 = "active"; 
        } 
         
         if ($setpage == "Reports"){
            $active11 = "active"; 
        } 
       
        if ($setpage == "Branches"){
            $active12 = "active"; 
        } 
        
        if ($setpage == "SendSMS"){
            $active13 = "active"; 
        } 
        
        if ($setpage == "ViewExamMarks"){
            $active14 = "active"; 
        } 
        
            if ($setpage == "StuVsPay"){
            $active15 = "active"; 
        }     
      
            if ($setpage == "StuVsAtten"){
            $active16 = "active"; 
        }    
                
             if ($setpage == "ViewJoinExamMarks"){
            $active17 = "active"; 
        }   
        
        if ($setpage == "BulkSMS"){
            $active18 = "active"; 
        } 
        
          if ($setpage == "Help"){
            $active19 = "active"; 
        } 
        
        if ($setpage == "Calendar"){
            $active20 = "active"; 
        } 
        
        if ($setpage == "Settings"){
            $active21 = "active"; 
        } 
         if ($setpage == "AddStudentPayments"){
            $active22 = "active"; 
        } 
        
         if ($setpage == "OnlineRegistrations"){
            $active23 = "active"; 
        } 
        
         if ($setpage == "A-P-ResultSheet"){
            $active24 = "active"; 
        }         
        
     }    
    

    
    ?>



    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <br>
            </div>
            <div class="pull-left info">
                
                <p style="font-size: x-small;"><?php echo $FirstName . " " . $LastName; ?> | <span style="color: #00ff00;">Online</span></p>

             
            </div>
          </div>
          
<?php

//Chack student avalibility....

  global $db;
  
if (isset($_POST['btn_sidebar_search'])) {
        $Sidebar_search_key = $_POST['StudentID'];
        
            $stmt5 = $db->prepare("SELECT stu_studentID, stu_studentname FROM `cp_students` WHERE stu_studentID LIKE '%{$Sidebar_search_key}%' OR stu_studentname LIKE '%{$Sidebar_search_key}%'");
            $stmt5->bind_result($VarStudent_id, $VarStudentName);
            $stmt5->execute(); 

             while ($stmt5->fetch()){

             }       
        
  if (($VarStudent_id OR $VarStudentName) == $Sidebar_search_key){
      //Jump to page
       echo "<script>location='index.php?page=ViewAllStudents&SearchKey=$Sidebar_search_key'</script>";
      
  } else {
      
      echo "<script>sweetAlert('Oops... OMG', 'No student under this ID..!! Check and Try Again', 'error');</script>";
      
  }      
        
    }          
          
?>


          
          <!-- search form -->
          <form action="" method="post" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="StudentID" class="form-control" placeholder="Search Name or ID...">
              <span class="input-group-btn">
                  <button type="submit" id="search-btn" name="btn_sidebar_search" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="dash.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            
    
            <li  class="treeview <?php echo $active1 . $active2 . $active3 . $active22 . $active23;  ?>">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Students</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul style="<?php //echo $Message; ?>" class="treeview-menu">
                  
                <li class="<?php echo $active23 ; ?>"><a href="index.php?page=OnlineRegistrations"><i class="fa fa-angle-double-right"></i>Online Registrations</a></li>
                <li class="<?php echo $active1 ; ?>"><a href="index.php?page=AddStudents&im=1"><i class="fa fa-angle-double-right"></i>Add Student</a></li>
                <li class="<?php echo $active2; ?>"><a href="index.php?page=ViewAllStudents&PageNo=1"><i class="fa fa-angle-double-right"></i> View All Students</a></li>
                <li class="<?php echo $active3; ?>"><a href="index.php?page=StudentAttendance"><i class="fa fa-angle-double-right"></i> Students Attendants</a></li>
                <li class="<?php echo $active22; ?>"><a href="index.php?page=AddStudentPayments"><i class="fa fa-angle-double-right"></i> Add Student Payments</a></li>
              </ul>
            </li>
 
 <?php
 // Select the user and assign permission...          
$stmt1129 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1129" ); 
$stmt1129->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1129->execute();

        while ($stmt1129->fetch()){ 

        }

          
 ?>
            
         <li class="treeview <?php echo $active5 . $active10. $active24. $active4 . $active14 . $active17; ?>" <?php if ($cp_userpermission_OnOff == 0){  ?> style="display: none;" <?php } ?>>          
              <a href="#">
                <i class="fa fa-usd"></i>
                <span>Courses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $active4 ; ?>"><a href="index.php?page=CourseAllocation"><i class="fa fa-angle-double-right"></i>Course Allocation</a></li>
                <li class="<?php echo $active5 ; ?>"><a href="index.php?page=SubNPay&PageNo=1"><i class="fa fa-angle-double-right"></i>Course &AMP; Payments</a></li>
                <!--<li class="<?php //echo $active17 ; ?>"><a href="index.php?page=ViewJoinExamMarks&PageNo=1"><i class="fa fa-angle-double-right"></i>View Join Exam Marks</a></li>  -->             
              </ul>
            </li>

            
            <li class="<?php echo $active11 ?>">
              <a href="index.php?page=Reports">
                <i class="fa fa-file-text"></i> <span>Reports</span>
              </a>
            </li>
            
             <li class="treeview <?php echo $active9 . $active12 . $active13 . $active15. $active16 . $active18 . $active20 . $active21; ?>">
              <a href="#">
                <i class="fa fa-cogs"></i>
                <span>Tools</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $active9 ; ?>"><a href="index.php?page=AddAnnouncement"><i class="fa fa-angle-double-right"></i>Announcements</a></li>
                       
                <li class="<?php echo $active21 ; ?>"><a href="index.php?page=Settings"><i class="fa fa-angle-double-right"></i>Settings</a></li>

              </ul>
            </li>
            
            <li class="<?php echo $active19 ?>">
              <a href="index.php?page=Help">
                <i class="fa fa-info-circle"></i> <span>Help</span>
              </a>
            </li>
                        
           <li class="treeview <?php echo $active7 . $active8; ?>">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class="<?php echo $active7; ?>"><a href="index.php?page=AddUser"><i class="fa fa-angle-double-right"></i>Add User</a></li>
                  <li class="<?php echo $active8; ?>"><a href="index.php?page=ViewAllUsers&PageNo=1"><i class="fa fa-angle-double-right"></i>View All Users</a></li>
              </ul>
            </li>
            
            <li>
                <a href="logout.php">
                <i class="fa fa-sign-out"></i> <span>Sign Out</span>
              </a>
            </li>

        </section>
         
        <!-- /.sidebar -->
      </aside>
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
     
?>