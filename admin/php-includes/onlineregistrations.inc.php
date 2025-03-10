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
$sql = "SELECT COUNT(stu_ID) FROM cp_online_reg_stu";
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
$sql = "SELECT * FROM cp_online_reg_stu ORDER BY stu_studentID ASC $limit";



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
		$paginationCtrls .= '<li><a href="index.php?page=OnlineRegistrations&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=OnlineRegistrations&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=OnlineRegistrations&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=OnlineRegistrations&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=OnlineRegistrations&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=OnlineRegistrations&PageNo='.$last.'">&raquo;&raquo;</a></li>'
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
            Online Registrations
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
<!--                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="ViewAllStudents">
                    <input style="margin-top: 10px;" class="form-control" type="text" name="SearchKey" value="<?php //echo $_GET['SearchKey']; ?>" placeholder="Student ID, Barcode or Name" required/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=ViewAllStudents&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                    <a style="margin-top: 10px; <?php //echo $style1130; ?>" target="_Blank" href="index.php?page=OldStudents&PageNo=1" class="btn btn-info btn-flat">Old Students</a>
                </form>-->
             
               
                 
                     
 <?php
 if(!isset($_GET["SearchKey"])){
     

 ?>
                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">                 
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Student Photo</th> 
                        <th>Student ID</th>
                        <th>Student Name</th>
                         <th>Student Note</th>
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
                                
<!--                                <button style="margin-top: 10px;" type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#changeMsg">Add Course</button>                -->

                                <br>
                   

                                <a href="index.php?page=AddStudents&StudentID=<?php echo $row['stu_studentID']; ?>&StudentPhoto=<?php echo $row['stu_image_name']; ?>&RegistrationDate=<?php echo $row['stu_regdate']; ?>&StudentName=<?php echo $row['stu_studentname']; ?>&Address=<?php echo $row['stu_address']; ?>&Sex=<?php echo $row['stu_sex']; ?>&BirthDate=<?php echo $row['stu_bday']; ?>&HomePhoneNumber=<?php echo $row['stu_con_home']; ?>&MobileNumber01=<?php echo $row['stu_con_mobile1']; ?>&MobileNumber02=<?php echo $row['stu_con_mobile2']; ?>&Email=<?php echo $row['stu_email']; ?>&NIC=<?php echo $row['stu_nic']; ?>&School=<?php echo $row['stu_school']; ?>&Accesskey=<?php echo $row['stu_accesskey']; ?> " target="_blank"  class="btn btn-app ">
                                <i class="fa fa-child"></i> Allocate
                                </a> 

                                <a href="" target="_blank"  data-toggle="modal" data-target="#<?php echo $row['stu_studentID']; ?>" class="btn btn-app ">
                                <i class="fa fa-pencil"></i> Add Note
                                </a>                                
                        </td>
                        
                        <td>
                            <img  src="Upload/studentphotos/<?php echo $row['stu_image_name']; ?>"  class="img-responsive " id="Uploadimg" name="Uploadimg" style=" margin: 0; width:100px;height:100px; border-radius: 5px;">                        
                        </td>
                        
                         <td><?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php  echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php  echo htmlentities($row['stu_notes'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><a href="tel:<?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?></a></td>

                      </tr>
                      

 <form name="addSubjectForm" action="" method="post">                
 <!-- Modal Window for Add Course-->
<div class="modal fade modal-danger" id="<?php echo $row['stu_studentID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Student Note</h4>
      </div>
      <div class="modal-body">
         
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $row['stu_studentID']; ?>" name="txt_stu_id" placeholder="AUTO" class="form-control" readonly>
                       </div>
                    </div>


                     <div class="form-group">
                          <label>Note</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="" name="txt_note" class="form-control">
                       </div>

                    </div>
                  
       
          
         
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
        <input  style="" class="btn  btn-success btn-flat" type="submit" onclick="" name="btn_submit_addNote" value="Add Note">
      
      </div>
       
    </div>
  </div>
</div>                 
</form>
                      <?php } ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Action</th>  
                        <th>Student Photo</th> 
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Note</th>
                        <th>Phone No</th>
                        
                      </tr>
                                    
                    </tfoot>
                   
                  </table> 
                            
                 </div>  
<!--                        <br>
                        HELP:
                        To send Birthday SMS to students, please type month and Date on the search box (Ex: 11-30)
                        Red SMS Button (Students are Available in the class) Green SMS Button (Student are not Available in the class) 
                        <br>
                        <br>-->
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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these Students ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deleteOnlineRegStu.php?page=OnlineRegistrations&PageNo=<?php echo $PNo ?>";  document.myform.submit(); } else {     swal("Cancelled", "Your Student records are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    


 <?php
                   
                   
               
                    } else {
                        

                       $SearchKey =  $_GET["SearchKey"]; 
                       
                       $sql_2 = "SELECT * FROM cp_online_reg_stu LEFT JOIN `cp_subj_allo` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id  WHERE cp_students.stu_studentID LIKE '%{$SearchKey}%' OR cp_students.stu_studentname LIKE '%{$SearchKey}%' OR cp_students.stu_barcode LIKE '%{$SearchKey}%' OR cp_students.stu_bday LIKE '%{$SearchKey}'";
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
                         <th>Student Note</th>
                        <th>Phone No</th>
                        <th>SMS</th>
                        
                        
                       
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
                                
                                <a href="index.php?page=AddCertificate&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&PageNo=<?php echo $PNo; ?>&StudentName=<?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>" target="_blank"  class="btn btn-app ">
                                <i class="fa fa-file-text-o"></i> Add Certificate
                                </a>                                 
                                
                                <a href="index.php?page=CourseAllocation&StudentID=<?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&StudentName=<?php echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>" target="_blank" class="btn btn-app ">
                                <i class="fa fa-child"></i> Allocate
                                </a>   
     
                                
                               <?php
                               
//                                    $varStuiD = $row['stu_studentID'];
//                                            
//                                    //This will show the Student Atten Details
//                                    $stmt_select_att_detail = $db->prepare("SELECT cp_subjects.subj_name, cp_students.stu_barcode, cp_subj_allo.sa_batch_no, cp_subj_allo.sa_subj_id FROM `cp_subj_allo` INNER JOIN `cp_subjects` ON cp_subj_allo.sa_subj_id = cp_subjects.subj_id INNER JOIN `cp_students` ON cp_students.stu_studentID = cp_subj_allo.sa_stu_student_id WHERE cp_subj_allo.sa_stu_student_id LIKE '%{$varStuiD}%'");
//                                    $stmt_select_att_detail->bind_result($subj_name, $stu_barcode, $sa_batch_no, $sa_subj_id);
//                                    $stmt_select_att_detail->execute(); 
//                                    
//                                    while ($stmt_select_att_detail->fetch()){
                                    
                               ?>
                                
<!--                                <a href="index.php?page=AddPayment&StudentID=<?php //echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8"); ?>&StudentName=<?php //echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8"); ?>&SubjID=<?php //echo $sa_subj_id; ?>&SubjName=<?php //echo $subj_name; ?>&ReceiptNo=787043305&BatchID=<?php //echo $sa_batch_no; ?>" target="_blank" class="btn btn-app ">
                                <i class="fa fa-usd"></i> Add Payment
                                </a>                                 -->
                                
                                <?php
                                 //   }
                                ?>
                                
                        </td>
                        
                        
                         <td><?php echo htmlentities($row['stu_studentID'], ENT_QUOTES, "UTF-8")  ?></td>
                         <td><?php  echo htmlentities($row['stu_studentname'], ENT_QUOTES, "UTF-8") ?></td>
                         <td><a href="tel:<?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlentities($row['stu_con_mobile1'], ENT_QUOTES, "UTF-8"); ?></a></td>
                         <td style="text-align: center;">
                             <a class="btn btn-info btn-flat" target="_blank" title="Send General SMS"  href="index.php?page=SendSMS&PhoneNub=<?php echo $row['stu_con_mobile1']; ?>"> <span class="fa fa-send"></span></a>
                             <a class="btn <?php echo $style; ?>  btn-flat" title="Send Birth Day SMS" target="_blank"  href="index.php?page=SendSMS&PhoneNub=<?php echo $row['stu_con_mobile1']; ?>&BdayMessage=Dear <?php echo $row['stu_studentname']; ?>, May you life be the best, I wish you a successful future and, Full marks in your Exam, Happy Birthday[Nuwan Sir]"><span class="fa fa-send"></span></a>

                         </td>
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
                        <th>SMS</th>
                        
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
                    <P style="padding-top: 10px; " class="">
                        
                        HELP:
                        To send Birthday SMS to students, please type month and Date on the search box (Ex: 11-30)
                        Red Button (Students are Available in the class) Green (Student are not Available in the class)
                    
                    
                    </P>           
                               
                                

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
        
            }  
        
       
        
        ?>  
        
            </div><!-- /.col -->
           
        
      
 <?php
 if(isset($_POST['btn_submit_addNote'])){
     
     
    global $db;


    if (isset($_POST['txt_stu_id'])) {
           $var_txt_stu_id = $_POST['txt_stu_id'];
    }

    if (isset($_POST['txt_note'])) {
        $var_txt_note =  $_POST['txt_note'];
    }
     
     
    $stmt_add_note = $db->prepare("UPDATE cp_online_reg_stu SET stu_notes=? WHERE `stu_studentID`=$var_txt_stu_id" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_add_note->bind_param('s', $var_txt_note);
    $stmt_add_note->execute();
    $stmt_add_note->close();   
 

       //Redirect to the page after inset
      echo "<script> window.location = 'index.php?page=OnlineRegistrations'";
      echo "</script>";
      
 }
 
 ?>
       

    
 

 <?php


   
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

 ?>