<?php

//ini_set('display_errors', '1'); ini_set('display_startup_errors', '1'); error_reporting(E_ALL);


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1118 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1118" ); 
$stmt1118->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1118->execute();

while ($stmt1118->fetch()){ 
    
}




//linked with update_barcode.fn.php
$UPDATE_BARCODE = upade_barcode();




     if(isset($_GET["SubjectID"])){
        $Subj_ID = $_GET["SubjectID"];
        
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
$sql = "SELECT COUNT(sa_id) FROM cp_subj_allo WHERE sa_subj_id=$Subj_ID";
$query = mysqli_query($db, $sql);
$row = mysqli_fetch_row($query);

if($cp_users_sp_id == 1){
    // Here we have the total row
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
$sql = "SELECT cp_subj_allo.sa_id, cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_subj_id, cp_subj_allo.sa_institutid, cp_subj_allo.sa_subj_fee, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_notes, cp_students.stu_studentname FROM `cp_subj_allo` INNER JOIN `cp_students` ON cp_subj_allo.sa_stu_student_id=cp_students.stu_studentID WHERE sa_subj_id=$Subj_ID ORDER BY cp_subj_allo.sa_stu_student_id ASC $limit";
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
		$paginationCtrls .= '<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=ViewSubjectAllocatedStudents&SubjectID='.$Subj_ID.'&PageNo='.$last.'">&raquo;&raquo;</a></li>'
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

        //$Message = "<p class='text-center'>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "Access Denied";
        //$Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>
            
          <h1>
            View Course Allocated Students
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Courses</a></li>
            <li class="active">Courses &AMP; Payments</li>
          </ol>
            
            
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box box-primary">
                  
            <div class="box-header with-border">
                <?php
                
                    //Select the database setting value
               $stmt2 = $db->prepare("SELECT subj_name FROM `cp_subjects` WHERE `subj_id`=$Subj_ID ");
               $stmt2->bind_result($Subj_Name);
               $stmt2->execute();
               

               
                while ($stmt2->fetch()){   
                    
                       
                
                ?>
                
                <h3 style="color: red;" class="box-title">Course Name: <?php echo $Subj_Name; ?></h3>
              
              <?php
               } 
              ?>
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
         
             <?php
             
             $SearchKey =  $_GET["SearchKey"];
             $SubjectID = $_GET["SubjectID"];
             
             if (!isset($_GET['SearchKey'])){
                 $btn_BConverter = "disabled";
                 
             }
             ?>
         <!-- Search Form -->       
         
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="ViewSubjectAllocatedStudents">
                    <input type="hidden" name="SubjectID" value="<?php echo $Subj_ID ?>">
                    <input style="margin-top: 10px; width: 260px" class="form-control" type="text" name="SearchKey" value="<?php echo $_GET['SearchKey']; ?>" placeholder="Barcode,Student ID,Name,Batch"/>                                        
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat"  type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=ViewSubjectAllocatedStudents&SubjectID=<?php echo $Subj_ID; ?>&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                    <a style="margin-top: 10px;" href="index.php?page=SubNPay&PageNo=1" class="btn btn-primary btn-flat" >View All Course</a>
                    <a style="margin-top: 10px;" href="index.php?page=BConverter&SubjectID=<?php echo $SubjectID; ?>&SearchKey=<?php echo $SearchKey; ?>" class="btn btn-danger btn-flat <?php echo $btn_BConverter; ?>">Batch Converter</a>
                    <a style="margin-top: 10px;" href="index.php?page=CConverter&SubjectID=<?php echo $SubjectID; ?>&SearchKey=<?php echo $SearchKey; ?>" class="btn btn-danger btn-flat <?php echo $btn_BConverter; ?>">Course Converter</a>
                    
              <!--      <a style="margin-top: 10px;" target="_Blank" href="index.php?page=OldStudentAllocations&SubjectID=<?php //echo $_GET['SubjectID']; ?>&PageNo=1" class="btn btn-info btn-flat">Old Students</a>   -->              
                </form>
             
             
                 
                     
 <?php
 if(!isset($_GET["SearchKey"])){

     

 ?>
            <?php
               $stmt3 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo WHERE sa_subj_id=$Subj_ID");
               $stmt3->bind_result($TotalStudents);
               $stmt3->execute();
               while ($stmt3->fetch()){
                 
                   if($cp_users_sp_id == 1){
                       
                       $TotalStudents = ceil($TotalStudents/2) ;
                       
                    } else {



                    }

                   
            }
        ?>
         
      <h4 class="box-title">Total Students: <?php echo $TotalStudents; ?></h4>
      
                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch No</th>
                        <th>Special Course Fee</th>
                        <th>Actions</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"]; 
                        $SUBJECT_ID = $_GET['SubjectID'];
                        
                        
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
                           {
                
                        ?>
                    
                        
                      <tr>
                         <td >  
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['sa_id'] ?>" />
                                <br>
  
                        </td>
                                <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>
                        
                         <td><?php echo htmlentities($row['sa_stu_student_id'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['sa_batch_no'], ENT_QUOTES, "UTF-8");  ?></td>
                         <!--<td><a href="../output/phpqrcode/ex.php?StudentID=<?php //echo $row['sa_stu_student_id']; ?>&StudentName=<?php //echo $row['stu_studentname']; ?>&ReceiptNo=<?php //echo $ReceiptNo; ?>" target="_blank" class="btn btn-success btn-flat" >Generate</a></td> -->
                         <!-- <td><a href="../output/barcode/ex.php?StudentID=<?php //echo $row['sa_stu_student_id']; ?>&StudentName=<?php //echo $row['stu_studentname']; ?>" target="_blank" class="btn btn-success btn-flat" >Generate</a></td>  -->   
                         
                         <td><?php echo htmlentities($row['sa_subj_fee'], ENT_QUOTES, "UTF-8");  ?></td>                          
                         
                         <td>
                             <button  type="button" class="btn btn-success btn-flat" data-toggle="modal" data-target="#<?php echo htmlentities($row['sa_stu_student_id'], ENT_QUOTES, "UTF-8");  ?>">Update Barcode</button>                
                            <!-- <a href="index.php?page=JoinExamMarks&StudentID=<?php //echo $row['sa_stu_student_id']; ?>&StudentName=<?php //echo $row['stu_studentname']; ?>&SubjectID=<?php //echo $SUBJECT_ID; ?>&BatchNo=<?php //echo $row['sa_batch_no']; ?>" target="_blank" class="btn btn-danger btn-flat" >Join Marks</a>--> 
                         </td>     
      
                         <td><?php echo $row['sa_notes'];  ?></td>               

                      </tr>
                      
                      
                       <!-- Update Barcode modal -->      
 <form name="addSubjectForm" action="" method="post">                
 <!-- Modal Window for Add Course-->
<div class="modal fade modal-danger" id="<?php echo htmlentities($row['sa_stu_student_id'], ENT_QUOTES, "UTF-8");  ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Barcode</h4>
      </div>
      <div class="modal-body">
         
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo htmlentities($row['sa_id'], ENT_QUOTES, "UTF-8");  ?>" name="txt_bar_sa_id"  class="form-control" readonly>
                       </div>
                    </div>


                     <div class="form-group">
                          <label>New Barcode</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="" name="txt_bar_new_barcode" class="form-control">
                       </div>

                    </div>
                          
          
         
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
        <input  style="" class="btn  btn-success btn-flat" type="submit" onclick="" name="btn_submit_update_barcode" value="Add this Barcode">
      
      </div>
       
    </div>
  </div>
</div>                 
</form>      
      
<!-- Update Barcode modal END -->      



                      <?php } ?>
                      
                   </tbody>
                  
                     
                  </table> 
              </div>
    </form> 
 
  
      
                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 
                  

                    <input style="margin-top: 5px;" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;"type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform.check_list)">
                    <input style="margin-top: 5px;" id="swalt" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction();">
                                
                               
                                

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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these items ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deletestuallo.php?page=ViewSubjectAllocatedStudents&SubjectID=<?php echo $SUBJECT_ID; ?>&PageNo=<?php echo $PNo ?>";  document.myform.submit(); } else {     swal("Cancelled", "Your items are safe :)", "error");   } });
                                   
                                    };
                                    
             

                                 
                                    </script>
                                    








 <?php
                   
                   
               
                    } else {
                        

                       $SearchKey =  $_GET["SearchKey"]; 

                       
                       $sql_2 = "SELECT cp_subj_allo.sa_id, cp_subj_allo.sa_stu_student_id, cp_subj_allo.sa_subj_id, cp_subj_allo.sa_institutid, cp_subj_allo.sa_subj_fee, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_notes, cp_subj_allo.sa_barCode, cp_students.stu_studentname FROM `cp_subj_allo` INNER JOIN `cp_students` ON cp_subj_allo.sa_stu_student_id=cp_students.stu_studentID WHERE (cp_subj_allo.sa_stu_student_id LIKE '%{$SearchKey}%' OR cp_students.stu_studentname LIKE '%{$SearchKey}%' OR cp_subj_allo.sa_batch_no LIKE '%{$SearchKey}%' OR cp_subj_allo.sa_barCode LIKE '%{$SearchKey}%') AND cp_subj_allo.sa_subj_id=$Subj_ID ORDER BY cp_subj_allo.sa_stu_student_id ASC";
                       $query_2 = mysqli_query($db, $sql_2);
                     
                       
                       
                   
                    
                   ?>
                       
            <?php
               $stmt4 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo WHERE sa_subj_id=$Subj_ID AND sa_batch_no LIKE '%{$SearchKey}%'");
               $stmt4->bind_result($TotalStudentsOnBatch);
               $stmt4->execute();
               
               while ($stmt4->fetch()){
                 
                   
            }
            
            
               $stmtInsName = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo INNER JOIN `cp_ins` ON cp_ins.ins_id = cp_subj_allo.sa_institutid WHERE sa_subj_id=$Subj_ID AND cp_ins.ins_name LIKE '%{$SearchKey}%'");
               $stmtInsName->bind_result($TotalStudentsOnInstitute);
               $stmtInsName->execute();
               
               while ($stmtInsName->fetch()){
                  
                   
            }
                  
           
        ?>
         
      <h4 class="box-title">Total Students in a Batch: <?php echo $TotalStudentsOnBatch; ?> | In a Branch: <?php echo $TotalStudentsOnInstitute; ?></h4>
      
 <!-- Search Result Table -->                                    
<form name="myform2" action="" method="post">
    <div class="box-body table-responsive no-padding">
    <table id="vas_table2" class="table table-hover table-bordered table-responsive">
                         
                
        
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch No</th>
                        <th>Special Course Fee</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"];  
                        $SKey = $_GET["SearchKey"];                                               
                        $SUBJECT_ID2 = $_GET['SubjectID'];
                        
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query_2, MYSQLI_ASSOC))
                           {
                
                        ?>
                    
                        
                      <tr>
                         <td >  
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['sa_id'] ?>" />
                                <br>
  
                        </td>
                        
                     
                                                
                                <?php
                                   //To generate payment ID
                                   $ReceiptNo =  rand();
                                ?>
                        
                         <td><?php echo htmlentities($row['sa_stu_student_id'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>
                             
                             <!-- Run in footer.inc.php-->
                             <br>
                             <a class="btn btn-success btn-flat Mark_Stu_atten" id="<?php echo $row['sa_stu_student_id'];  ?>" >Mark Attn.</a>
                             <a class="btn btn-danger btn-flat Mark_Stu_absent" id="<?php echo $row['sa_stu_student_id'];  ?>" >Mark Absent</a>
                                                  
                         
                         </td>
                         <td><?php echo htmlentities($row['sa_batch_no'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['sa_subj_fee'], ENT_QUOTES, "UTF-8");  ?></td> 
                         <td><?php echo $row['sa_notes'];  ?></td>            
                      
                         
                    
                        <script>
                            document.getElementById("AddMarksBtu").focus();
                        </script>                 
                    
              
                    

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                  
                  </table>    
    </div>
   </form>  
                                    
                                    
                                    
                    <input type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform2.check_list)">
                    <input type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform2.check_list)">
                    <input id="swalt2" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction2();">
                                
                               
                                

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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these items ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform2.action = "actions/deletestuallo.php?page=ViewSubjectAllocatedStudents&SubjectID=<?php echo $SUBJECT_ID2; ?>&SearchKey=<?php echo $SKey; ?>";  document.myform2.submit(); } else {     swal("Cancelled", "Your items are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    
                                    
              <?php
              }
              }
              ?>                 
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </section><!-- /.content -->
            </div><!-- /.col -->
       
        <?php   
        
        
                           }  
                           
        // Close your database connection and Other Connections...
//        $stmt1118->close();
//        $stmt2->close();
//        $stmt1->close();
//        $stmt2->close();
//        $stmt->close();
//        $stmt3->close();
//        $stmt4->close();
        $db->close();
        mysqli_close($db);
        
        ?>  
      
 



 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
    
}

      
?>
    