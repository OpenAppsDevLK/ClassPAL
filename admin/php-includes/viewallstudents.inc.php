<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1112 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1112" ); 
$stmt1112->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1112->execute();

while ($stmt1112->fetch()){ 
    
}


 //Select the user and assign permission...          
$stmt1130 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1130" ); 
$stmt1130->bind_result($cp_users_id1130, $cp_users_firstname1130, $cp_users_lastname1130, $cp_users_sp_id1130, $cp_userpermission_permission_id1130, $cp_userpermission_uid1130, $cp_userpermission_OnOff1130);
$stmt1130->execute();

while ($stmt1130->fetch()){ 
    
}



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
$sql = "SELECT COUNT(stu_ID) FROM cp_students";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);

if($cp_users_sp_id == 1){
    // Here we have the total row count
    $rows = $row[0]/2;
} else {
    
    // Here we have the total row count
    $rows = $row[0];
}



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
$sql = "SELECT * FROM cp_students ORDER BY stu_studentID ASC $limit";



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
		$paginationCtrls .= '<li><a href="index.php?page=ViewAllStudents&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=ViewAllStudents&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=ViewAllStudents&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=ViewAllStudents&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=ViewAllStudents&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=ViewAllStudents&PageNo='.$last.'">&raquo;&raquo;</a></li>'
                         .'</ul>';
    }
}
    


 
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
            View All Students
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li class="active">View All Students</li>
          </ol>
            
            
        </section>

        
        <!-- Main content -->
        <section class="content">
              <div class="box box-primary">
                  
            <div class="box-header with-border">
              <h3 class="box-title">All Students</h3>
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
                      </select>
                          

                      </div>
                       
                   </div>

                    
               </form> 
             
         <!-- Search Form -->       
 <?php
 if ($cp_userpermission_OnOff1130 == 0){
     
     $style1130 = "display: none;";
     
 }
 
 ?>
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="ViewAllStudents">
                    <input style="margin-top: 10px;" class="form-control" type="text" name="SearchKey" value="<?php echo $_GET['SearchKey']; ?>" placeholder="Student ID, Barcode or Name" required/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=ViewAllStudents&PageNo=1" class="btn btn-success btn-flat" >View All</a>
<!--                    <a style="margin-top: 10px; <?php echo $style1130; ?>" target="_Blank" href="index.php?page=OldStudents&PageNo=1" class="btn btn-info btn-flat">Old Students</a>-->
                </form>
             
               
                 
                     
 <?php
 if(!isset($_GET["SearchKey"])){
     

 ?>
                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">                 
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone No</th>
                        
                       
                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"];  
                        
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
                           {
                
                        ?>
                    
                        
                        <tr>
                         <td >  

                            
                             
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['stu_studentID'] ?>" />
                                <br>
                                
                                <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>
                                                        
<!--                                <a href="index.php?page=AddPayment&StudentID=<?php //echo htmlentities($row['stu_studentID'] , ENT_QUOTES, "UTF-8"); ?>&StudentName=<?php //echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>&PageNo=<?php //echo $PNo; ?>&ReceiptNo=<?php //echo $ReceiptNo; ?>" class="btn btn-app ">
                                <i class="fa fa-usd"></i> Add Payment
                                </a> -->

                                <a href="index.php?page=UpdateStudentDetails&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&PageNo=<?php echo $PNo; ?> " target="_blank"  class="btn btn-app ">
                                <i class="fa fa-edit"></i> Edit
                                </a> 
                               
                                
                                <a href="index.php?page=CourseAllocation&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&StudentName=<?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>" target="_blank" class="btn btn-app ">
                                <i class="fa fa-child"></i> Allocate Student
                                </a>      
                        </td>
                        
                        
                         <td><?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php  echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><a href="tel:<?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?></a></td>

                      </tr>
                      


                      <?php } ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Action</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone No</th>
                        
                        
                      </tr>
                                    
                    </tfoot>
                   
                  </table> 
                            
                 </div>  
    </form> 
        
<?php
          
    $stmt1115 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1115" ); 
    $stmt1115->bind_result($cp_users_id1115, $cp_users_firstname1115, $cp_users_lastname1115, $cp_userpermission_permission_id1115, $cp_userpermission_uid1115, $cp_userpermission_OnOff1115);
    $stmt1115->execute();

while ($stmt1115->fetch()){ 
    
}
 
    if ($cp_userpermission_OnOff1115 == 0){

        $Message1 = "display: none;";
        //echo $Message1;
        
    }
 
 ?>

                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 
                  
                     
                    <input style="margin-top: 5px; <?php echo $Message1; ?>" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px; <?php echo $Message1; ?>"type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px; <?php echo $Message1; ?>" id="swalt" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction();">
                                
                               
                                

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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these Students ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deleteallstu.php?page=ViewAllStudents&PageNo=<?php echo $PNo ?>";  document.myform.submit(); } else {     swal("Cancelled", "Your Student records are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    


 <?php
                   
                   
               
                    } else {
                        

                       $SearchKey =  $_GET["SearchKey"]; 
                       
                       $sql_2 = "SELECT * FROM cp_students LEFT JOIN `cp_subj_allo` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id  WHERE cp_students.stu_studentID LIKE '%{$SearchKey}%' OR cp_students.stu_studentname LIKE '%{$SearchKey}%' OR cp_subj_allo.sa_barCode LIKE '%{$SearchKey}%' GROUP BY cp_students.stu_studentID";
                       
                       $query_2 = mysqli_query($db, $sql_2);
                     
                       
                  
                   
                    
                   ?>
  
        
         
 <!-- Search Result Table -->                                    
<form name="myform2" action="" method="post">      
 <div class="box-body table-responsive no-padding">   
    <table id="vas_table2" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone No</th>
                        
                        
                        
                       
                      </tr>
                    </thead>
                    <tbody>
                        

                        <?php

                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query_2, MYSQLI_ASSOC))
                           {
                 
                               //Student avalability check, if student avalable on student table ad allocation table, SMS button 
                               //will turn to red if not Green
                               $cp_students_stu_studentID = $row['stu_studentID'];
                               $cp_subj_allo_sa_stu_student_id = $row['sa_stu_student_id'];
                               
                               if ($cp_students_stu_studentID == $cp_subj_allo_sa_stu_student_id){
                                   
                                   $style = "btn-danger";
                                   
                               } else {
                                   
                                   $style = "btn-success";
                                   
                               }
                        ?>
                    
                        
                 <tr>
                         <td >  

                            
                             
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>" />
                                <br>
                                
                                <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>
                                                        
                                <a href="index.php?page=UpdateStudentDetails&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&SearchKey=<?php echo $SearchKey; ?>" target="_blank"  class="btn btn-app ">
                                <i class="fa fa-edit"></i> Edit
                                </a> 
                                                               
                                
                                <a href="index.php?page=CourseAllocation&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&StudentName=<?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>" target="_blank" class="btn btn-app ">
                                <i class="fa fa-child"></i> Allocate Student
                                </a>   
     
                               
                                
                        </td>
                        
                        
                         <td><?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8")  ?></td>
                         <td><?php  echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8") ?></td>
                         <td><a href="tel:<?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?></a></td>
                      </tr>
                      
                      
                  
                   <?php

                           }
                           
                   ?>

                     
                     

                    </tbody>       
                     <tfoot>
                      <tr>
                        <th>Action</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Phone No</th>
                        
                      </tr>
                    </tfoot>
                  </table>  
 </div>       
  
                                    
<?php

    $stmt1115 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1115" ); 
    $stmt1115->bind_result($cp_users_id1115, $cp_users_firstname1115, $cp_users_lastname1115, $cp_userpermission_permission_id1115, $cp_userpermission_uid1115, $cp_userpermission_OnOff1115);
    $stmt1115->execute();
 
    while ($stmt1115->fetch()){ 
    
    }

    if ($cp_userpermission_OnOff1115 == 0){

        $Message2 = "display: none;";
        //echo $Message1;
        
    }
    

?>
                                    
                    <input style="margin-top: 5px; <?php echo $Message2; ?>" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform2.check_list)">
                    <input style="margin-top: 5px; <?php echo $Message2; ?>" type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform2.check_list)">
                    <input style="margin-top: 5px; <?php echo $Message2; ?>" id="swalt2" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction2();">
          
                               
                                

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
                                    document.querySelector('#swalt2').onclick = function setDeleteAction2(){
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these Students ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform2.action = "actions/deleteallstu.php?page=ViewAllStudents&SearchKey=<?php echo $SearchKey ?>";  document.myform2.submit(); } else {     swal("Cancelled", "Your student records are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
          </form>                             
                                    
              <?php
              }
              ?> 
                                   
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
               </section>
        
        
                <?php   
            // Close your database connection and Other Connections...
            //           $stmt1112->close();
            //           $stmt2->close();
            //           $stmt1->close();
            //           $stmt->close();
            //           $stmt1115->close();
           $db->close();
           mysqli_close($db);        
        
            }  
        
       
        
        ?>  
        
            </div><!-- /.col -->
           
        
      
          
       

    
 

 <?php


   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

 ?>