<?php

    
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...          
$stmt1119 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1119" ); 
$stmt1119->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1119->execute();

while ($stmt1119->fetch()){ 
    
}

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
$sql = "SELECT COUNT(pay_id) FROM cp_payments WHERE pay_subj_id=$Subj_ID";
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
$sql = "SELECT cp_payments.pay_id, cp_payments.Pay_stu_studentID, cp_payments.pay_student_name, cp_payments.pay_subj_id, cp_payments.pay_insName, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_fee, cp_payments.pay_cos_admi, cp_payments.pay_cos_total, cp_payments.pay_misc_pay_description, cp_payments.pay_misc_amount, cp_payments.pay_stu_batch_no FROM `cp_payments` WHERE pay_subj_id=$Subj_ID ORDER BY pay_paymentdate DESC $limit";


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
		$paginationCtrls .= '<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=ViewAllPayments&SubjectID='.$Subj_ID.'&PageNo='.$last.'">&raquo;&raquo;</a></li>'
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
            View All Payments
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
             
         <!-- Search Form -->       
                       
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="ViewAllPayments">
                    <input type="hidden" name="SubjectID" value="<?php echo $Subj_ID ?>">
                    <input style="margin-top: 10px; width: 220px" class="form-control" type="text" name="SearchKey" value="<?php echo $_GET['SearchKey']; ?>" placeholder="Barcode,Student ID, Name or Paid Month"/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=ViewAllPayments&SubjectID=<?php echo $Subj_ID; ?>&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                    <a style="margin-top: 10px;" href="index.php?page=SubNPay&PageNo=1" class="btn btn-primary btn-flat" >View All Courses</a>
                </form>
             
               
                 
                     
 <?php
 if(!isset($_GET["SearchKey"])){
 ?>
 
        <?php
               $stmt3 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_subj_id=$Subj_ID");
               $stmt3->bind_result($TotalIncome);
               $stmt3->execute();
               while ($stmt3->fetch()){
                 
                 $TotalIncome = number_format($TotalIncome, 2, '.', '');   
                 
                 if($cp_users_sp_id == 1){
                     
                     $TotalIncome = ceil($TotalIncome/2) ;

                    } 

            }
        ?>
         
      <h4 class="box-title">Total Income: Rs. <?php echo $TotalIncome; ?></h4>
      
                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Pay ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch Number</th>
                        <th>Pay Date</th>
                        <th>Pay Month</th>
                        <th>Courses fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                        <th>Misc Pay Description</th>
                        <th>Misc Pay Amount</th>
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
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['pay_id'] ?>" />
                                <br>
  
                        </td>
                        
                        
                         <td><?php echo htmlentities($row['pay_id'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['Pay_stu_studentID'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_student_name'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_stu_batch_no'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_paymentdate'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_paymentmonth'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_cos_fee'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_cos_admi'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_cos_total'], ENT_QUOTES, "UTF-8");  ?></td>
                         
                         <td><?php echo htmlentities($row['pay_misc_pay_description'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_misc_amount'], ENT_QUOTES, "UTF-8");  ?></td>
                         
                      

                      </tr>
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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform.action = "actions/deletepayments.php?page=ViewAllPayments&SubjectID=<?php echo $SUBJECT_ID; ?>&PageNo=<?php echo $PNo ?>";  document.myform.submit(); } else {     swal("Cancelled", "Your items are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    








 <?php
                   
                   
               
                    } else {
                        

                       $SearchKey =  $_GET["SearchKey"]; 
                       
                      $sql_2 = "SELECT cp_payments.pay_id, cp_payments.Pay_stu_studentID, cp_payments.pay_student_name, cp_payments.pay_subj_id, cp_payments.pay_insName, cp_payments.pay_paymentdate, cp_payments.pay_paymentmonth, cp_payments.pay_cos_fee, cp_payments.pay_cos_admi, cp_payments.pay_cos_total, cp_payments.pay_misc_pay_description, cp_payments.pay_misc_amount, cp_payments.pay_stu_batch_no, cp_subj_allo.sa_barCode FROM `cp_payments` LEFT JOIN `cp_subj_allo` ON cp_subj_allo.sa_stu_student_id = cp_payments.Pay_stu_studentID WHERE (Pay_stu_studentID LIKE '%{$SearchKey}%' OR pay_student_name LIKE '%{$SearchKey}%' OR pay_stu_batch_no LIKE '%{$SearchKey}%' OR pay_paymentmonth LIKE '%{$SearchKey}%' OR sa_barCode LIKE '%{$SearchKey}%') AND pay_subj_id=$Subj_ID ORDER BY pay_paymentdate DESC";

                       $query_2 = mysqli_query($db, $sql_2);
                     
                       
                       
                   
                    
                   ?>
 
        <?php
               $stmt3 = $db->prepare("SELECT SUM(pay_cos_total) FROM `cp_payments` LEFT JOIN `cp_subj_allo` ON cp_subj_allo.sa_stu_student_id = cp_payments.Pay_stu_studentID WHERE (Pay_stu_studentID LIKE '%{$SearchKey}%' OR pay_student_name LIKE '%{$SearchKey}%' OR pay_stu_batch_no LIKE '%{$SearchKey}%' OR pay_paymentmonth LIKE '%{$SearchKey}%' OR sa_barCode LIKE '%{$SearchKey}%') AND pay_subj_id=$Subj_ID");
               $stmt3->bind_result($TotalIncome);
               $stmt3->execute();
               while ($stmt3->fetch()){
                 
                 $TotalIncome = number_format($TotalIncome, 2, '.', '');   
            }
        ?>
         
      <h4 class="box-title">Total Income: Rs. <?php echo $TotalIncome; ?></h4>
      
 <!-- Search Result Table -->                                    
<form name="myform2" action="" method="post">
    <div class="box-body table-responsive no-padding">
    <table id="vas_table2" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>  
                        <th>Pay ID</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Batch Number</th>
                        <th>Pay Date</th>
                        <th>Pay Month</th>
                        <th>Courses fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                        <th>Misc Pay Description</th>
                        <th>Misc Pay Amount</th>
                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"];  
                        $SUBJECT_ID2 = $_GET['SubjectID'];
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query_2, MYSQLI_ASSOC))
                           {
                
                        ?>
                    
                        
                      <tr>
                         <td >  
                                <input name="checkbox[]" type="checkbox" style="width:15px; height: 15px; border-radius: 0px;" id="check_list" value="<?php echo $row['pay_id'] ?>" />
                                <br>
  
                        </td>
                        
                        
                         <td><?php echo htmlentities($row['pay_id'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['Pay_stu_studentID'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_student_name'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_stu_batch_no'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_paymentdate'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_paymentmonth'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_cos_fee'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_cos_admi'], ENT_QUOTES, "UTF-8"); ?></td>
                         <td><?php echo htmlentities($row['pay_cos_total'], ENT_QUOTES, "UTF-8");  ?></td>
                         
                         <td><?php echo htmlentities($row['pay_misc_pay_description'], ENT_QUOTES, "UTF-8");  ?></td>
                         <td><?php echo htmlentities($row['pay_misc_amount'], ENT_QUOTES, "UTF-8");  ?></td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                   
                  </table>    
    </div>
   </form>  
                                    
                                    
                                    
                    <input style="margin-top: 5px;" type="button" class="btn btn-primary" name="Check_All" value="Check All" onClick="CheckAll(document.myform2.check_list)">
                    <input style="margin-top: 5px;" type="button" class="btn btn-success" name="Un_CheckAll" value="Uncheck All" onClick="UnCheckAll(document.myform2.check_list)">
                    <input style="margin-top: 5px;" id="swalt2" type="button" class="btn btn-danger" name="delete" value="Delete All" onClick="setDeleteAction2();">
                                
                               
                                

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
                                    swal({   title: "Are you sure?",   text: "Do you want to delete these items ?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete them all!",   cancelButtonText: "No, No.. Cancel Please!",   closeOnConfirm: false,   closeOnCancel: false }, function(isConfirm){   if (isConfirm) {  document.myform2.action = "actions/deletepayments.php?page=ViewAllPayments&SubjectID=<?php echo $SUBJECT_ID2; ?>&SearchKey=<?php echo $SearchKey ?>";  document.myform2.submit(); } else {     swal("Cancelled", "Your items are safe :)", "error");   } });
                                   
                                    };

                                 
                                    </script>
                                    
                                    
              <?php
              }
              ?>

                          
                  
                           <?php
                            }                    
                           ?>
                    
                    

                                    
                                    
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </section><!-- /.content -->
            </div><!-- /.col -->
         
        
        <?php   
        
        
                           }  
        
                        // Close your database connection and Other Connections...
//                        $stmt1119->close();
//                        $stmt2->close();
//                        $stmt1->close();
//                        $stmt2->close();
//                        $stmt->close();
                        $db->close();
                        mysqli_close($db);        
        
        ?>  
    
 

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

      
?>
   

    