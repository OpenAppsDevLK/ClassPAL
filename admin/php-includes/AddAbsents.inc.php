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


//Link with studentabsents.fn.php
$ADDABSENTS = addabsents();


?>

<?php

    // If the value is set form POST request to $ShowRecords1, that value will update on the database...
     if (isset($_POST["shorec"])){
   $ShowRecords1 = $_POST["shorec"];



     // Update the database from selected value
     $stmt2 = $db->prepare("UPDATE cp_settings SET showrecords=? WHERE `setting_id`=1 ");
     $stmt2->bind_param('i',$ShowRecords1);
     $stmt2->execute(); 
     //$stmt->close();

   }


 ?>


<?php

global $db;

                   
     //Select the database "setting" value and Set that value to $ShowRecords1 to genarate the records...
    $stmt1 = $db->prepare("SELECT showrecords FROM `cp_settings` WHERE `setting_id`=1 ");
    $stmt1->bind_result($ShowRecords1);
    $stmt1->execute();
    

    
    while ($stmt1->fetch()){ 
        
    }   
    
        
// This first query is just to get the total count of rows
$sql = "SELECT COUNT(id) FROM cp_absent";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);

// Here we have the total row count
$rows = $row[0];

// This is the number of results we want displayed per page, $ShowRecords1 select form database "setting" table...
$page_rows = $ShowRecords1;

// This tells us the page number of our last page
$last = ceil($rows/$page_rows);

// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}

// Establish the $pagenum variable (Page Numbers)
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['PageNo'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['PageNo']);
}

// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}

// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

// This is your query again , it is for grabbing just one page worth of rows by applying $limit
$sql = "SELECT cp_absent.id, cp_absent.student_id, cp_absent.date, cp_students.stu_studentID, cp_students.stu_studentname, cp_subjects.subj_id, cp_subjects.subj_name  FROM `cp_absent` LEFT JOIN `cp_students` ON cp_absent.student_id=cp_students.stu_studentID LEFT JOIN `cp_subjects` ON cp_subjects.subj_id = cp_absent.subj_id ORDER BY cp_absent.date DESC $limit";

$query = mysqli_query($db, $sql);

// This shows the user what page they are on, and the total number of pages
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";


// Establish the $paginationCtrls variable
$paginationCtrls = '<ul class="pagination pagination-sm no-margin">';
 //If there is more than 1 page worth of results
if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<li><a href="index.php?page=AddAbsents&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=AddAbsents&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=AddAbsents&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=AddAbsents&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=AddAbsents&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=AddAbsents&PageNo='.$last.'">&raquo;&raquo;</a></li>'
                         .'</ul>';
    }
}
    




 
?>

<script language="javascript" type="text/javascript" >
//This code will runs, select menu to select customs...

function jumpto(x){

if (document.form1.jumpmenu.value != "null") {
	document.location.href = x
	}
}

</script>

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
            Student Absents
            <small>You can mark daily students absents details form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">Student Attendance</a></li>
            <li class="active">Student Absents</li>
          </ol>
        </section>

        <!-- Main content Add attendance -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student Absents</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
             <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Mark Student Absents</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                  <?php 

                    //This will show the subject details
                    $stmt5 = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects`");
                    $stmt5->bind_result($Subj_id, $Subj_Name, $subj_Fee);
                    $stmt5->execute();

                  ?>
                    
                    <label style="color: red;">Select Subject Name</label>
                    <div class="input-group has-error">
                    <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                    </div>   
                      <form name="form1" id="form_addsubject" role="form" action="" method="get">
                          <select class="form-control" name="jumpmenu" onChange="jumpto(document.form1.jumpmenu.options[document.form1.jumpmenu.options.selectedIndex].value)" required>
                         <option value="" disabled selected><?php echo $_GET['SubjID'] . " ". $_GET['SubjName'] ?></option>
                          <?php
                          
                          if (isset($_GET['SubjID'])){
                              $Subj_id = $_GET['SubjID'];
                              $Subj_Name = $_GET['SubjName'];
                              
                          }
                          
                          
                          while ($stmt5->fetch()){
                              
                          
                         ?>
                         <option value="index.php?page=AddAbsents&SubjID=<?php echo $Subj_id  ?>&SubjName=<?php echo $Subj_Name;  ?>"> <?php echo $Subj_id ." ". $Subj_Name; ?></option>

                        <?php
                        }
                        ?>
                      </select>
                              
                      </form>
                        
                        
                    </div>
                    <hr>                     
                                         
                  <form id="form_addstudent" role="form" action="<?php  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->

                     
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_abID" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" value="<?php echo date('Y-m-d'); ?>" name="txt_abdate" class="form-control">
                    </div>                
                   
                    <label>Subject Name</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-book"></i>
                    </div> 
                        
                  <input type="text" value="<?php echo $_GET['SubjID'] . $_GET['SubjName']; ?>" name="txt_ab_SubjectID" class="form-control" readonly>
                   
                    </div>
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="number" name="txt_ab_student_id" class="form-control" required autofocus >
                       </div>
                    </div>

             
           <div class="box-footer">
              
                <div style="margin-bottom: 10px;"class= "col-lg-6 col-md-12 col-xs-1">
                <input style="margin-bottom: 10px;" class="btn  btn-success" type="submit" name="btn_ab" value="Add to Absents">                
                </div>
               
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->
        </div>
      </div>
        </section><!-- /.content End Add attendance -->
        
        

        
        
  <!-- Main content View attendance -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View All Students Absents</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                
            <!-- Paging Text -->   
             <div><?php echo $textline2; ?></div>   
            <form class="form-inline" method="POST" action="">  
                
                   <div class="form-group">
                     <input style="margin-bottom: 10px;" class="btn btn-sm btn-success" type="submit" value="Show" onclick="" name="submit" />                   
                      <div class="input-group">                     
                          <select style="margin-bottom: 10px;" name="shorec" class="form-control input-sm">
                          
                          <?php
                          
                            //Select the database setting value
                           $stmt = $db->prepare("SELECT showrecords FROM `cp_settings` WHERE `setting_id`=1 ");
                           $stmt->bind_result($ShowRecords1);
                           $stmt->execute();

                           
                           
                           while ($stmt->fetch()){ 
                               
                          
                          
                          ?>
                                <option><?php echo $ShowRecords1; ?></option> 
                        
                            <?php
                             }
                            ?>
                        
                        
                        <option>5</option>
                        <option>10</option>
                        <option>50</option>
                        <option>100</option>
                        <option>250</option>
                        <option>500</option>
                        <option>1000</option>
                        <option>2500</option>
                        <option>5000</option>
                      </select>
                          

                      </div>
                       
                   </div>

                    
               </form> 
             
             
                              <!-- general form elements disabled -->
           
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Students Absents</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
         <!-- Search Form -->       
                       
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="AddAbsents">
                    <input style="margin-top: 10px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Student ID or Name"/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=AddAbsents&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                </form>
         
         
                   <form name="myform" action="" method="post">
                    
 <?php
 if(!isset($_GET["SearchKey"])){
     
 
 ?>
                     <div class="" id="pagination_controls"><?php echo $paginationCtrls; ?> </div>                  
                 
            <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-hover table-bordered">

                    <thead>
                      <tr>
                          
                        <th>Select</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject Name</th>
                        <th>Absent Date</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                     while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
                             
                    {
                 
                        
                        ?>
                        
                      <tr>
                          
                      <td><input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['id'] ?>" /></td>                          
                      <td><?php echo $row['student_id']; ?></td>
                      <td><?php echo $row['stu_studentname']; ?></td>
                      <td><?php echo $row['subj_name']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                       
                      </tr>
                     
                   <?php
                   
                   }
                   
                   ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                          
                        <th>Select</th>   
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject Name</th>
                         <th>Absent Date</th>
                        
                      </tr>
                    </tfoot>
 
                  </table>
                </div>

                     
                    <input style="margin-top: 5px;" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;"type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;" id="swalt" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction();">
                                
                               
                        <?php
                        $PNo = $_GET['PageNo'];
                        
                        ?>

			<SCRIPT LANGUAGE="JavaScript">
                                    <!-- 

                                    <!-- Begin
                                    function CheckAll(chk)
                                    {
                                    for (i = 0; i < chk.length; i++)
                                    chk[i].checked = true ;
                                    }

                                    function UnCheckAll(chk)
                                    {
                                    for (i = 0; i < chk.length; i++)
                                    chk[i].checked = false ;
                                    }
                                    // End -->
                                    
                                    //Sweet Alert Class (linked with head)
                                    document.querySelector('#swalt').onclick = function setDeleteAction(){
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these Student Attendance ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deleteabsents.php?page=StudentAttendance&PageNo=<?php echo $PNo; ?>";  document.myform.submit(); } else {     swal("Cancelled", "There are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    
                <?php
                } else {
                    

                    
                       $SearchKey =  $_GET["SearchKey"]; 
                       
                       $sql_2 = "SELECT cp_absent.id,cp_absent.student_id, cp_absent.date, cp_students.stu_studentID, cp_students.stu_studentname, cp_subjects.subj_id, cp_subjects.subj_name  FROM `cp_absent` LEFT JOIN `cp_students` ON cp_absent.student_id=cp_students.stu_studentID LEFT JOIN `cp_subjects` ON cp_subjects.subj_id = cp_absent.subj_id WHERE cp_absent.student_id LIKE '%{$SearchKey}%' OR cp_students.stu_studentname LIKE '%{$SearchKey}%' ORDER BY cp_absent.date DESC";
                       $query_2 = mysqli_query($db, $sql_2);
                     
                       
                    
                    
               
                ?>
      <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-hover table-bordered">

                    <thead>
                      <tr>
                         
                        <th>Select</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject Name</th>
                        <th>Absent Date</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                     while($row = mysqli_fetch_array($query_2, MYSQLI_ASSOC))
                             
                    {
                 
                        
                        ?>
                                   
                      <tr>
                          
                      <td><input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['id'] ?>" /></td>                          
                      <td><?php echo $row['student_id']; ?></td>
                      <td><?php echo $row['stu_studentname']; ?></td>
                      <td><?php echo $row['subj_name']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                       
                      </tr>
                     
                   <?php
                   
                   }
                   
                   ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                          
                        <th>Select</th>   
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Subject Name</th>
                        <th>Absent Date</th>
                        
                      </tr>
                    </tfoot>
 
                                    
                  </table>
      </div>     
                       
                       
                     <input style="margin-top: 5px;" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;"type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;" id="swalt" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction();">
                                
                               
                        <?php
                        $SearchKeyforDelete = $_GET['SearchKey'];
                        
                        ?>

			<SCRIPT LANGUAGE="JavaScript">
                                    <!-- 

                                    <!-- Begin
                                    function CheckAll(chk)
                                    {
                                    for (i = 0; i < chk.length; i++)
                                    chk[i].checked = true ;
                                    }

                                    function UnCheckAll(chk)
                                    {
                                    for (i = 0; i < chk.length; i++)
                                    chk[i].checked = false ;
                                    }
                                    // End -->
                                    
                                    //Sweet Alert Class (linked with head)
                                    document.querySelector('#swalt').onclick = function setDeleteAction(){
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these Student Attendance ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deleteabsents.php?page=StudentAttendance&SearchKey=<?php echo $SearchKeyforDelete; ?>";  document.myform.submit(); } else {     swal("Cancelled", "There are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>                      
                       
                     </form>
                    
                          <?php
                             }
                           ?>
                    
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->
                </div>
              </div>
        </section><!-- /.content End view attendance -->
     <?php   
                    }  
                    
                // Close your database connection and Other Connections...
//                $stmt1116->close();
//                $stmt2->close();
//                $stmt1->close();
//                $stmt5->close();
//                $stmt->close();
                $db->close();
                mysqli_close($db);                               
    ?> 
      </div><!-- /.content-wrapper -->

<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login123.php');
}

      
?>
