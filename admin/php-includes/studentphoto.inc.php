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
            Add Student Photo
            <small>You can add students photo form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">Add Student</a></li>
             <li class="active">Add Student Photo</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student Photo</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Upload a Photo</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    
                    <form id="form_addstudent" style="<?php //echo $addStyle; ?>" role="form" action="<?php $ADDSTUDENT;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    <div class="form-group">
                      <label>Student ID</label>
                      <input type="text" name="txt_StuID" class="form-control" value="<?php echo $_GET['StudentID']; ?>" placeholder="AUTO" readonly>
                    </div>
                    
  <?php
 
  if(isset($_GET['StudentID'])){
             $Student_ID = $_GET['StudentID']; 
          
             
                        $stmt = $db->prepare("SELECT stu_image_name FROM `cp_students` WHERE stu_studentID= $Student_ID") ;
                        $stmt->bind_result($UploadName);
                        $stmt->execute();
                    
                        while ($stmt->fetch()){
                            
                            
                            
                        }
  }
 
 ?>             
       <div class="col-md-12">                  
                <div class="form-group">
                    <hr>
                    <img  src="../Upload/<?php echo $UploadName; ?>"  class="img-responsive " id="Uploadimg" name="Uploadimg" style=" margin: 0; width:300px;height:300px; ">       
                     <hr>
                </div> 
      </div>
                        
                   <div class="form-group">
                        <input type="button" class="btn btn-lg  btn-danger" value="Click to Add Student Photo" onclick="window.open('http://maxweem.com/apps/classpalnew/Upload/uploadstudentphoto.php?StudentID=<?php echo $_GET['StudentID']; ?>','popUpWindow','height=300,width=800,left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');">   
                        <button class="btn  btn-info" style=" margin: 10px" onclick="location.reload();">Refresh</button>

                    </div>      
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <a style="margin-top: 5px;" href="index.php?page=AddStudents" class="btn  btn-success btn-lg">Add Another Student </a>                    
                <a style="margin-top: 5px;" href="index.php?page=ViewAllStudents" class="btn  btn-danger">View All Students </a>
               
                </div>
            
                    
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