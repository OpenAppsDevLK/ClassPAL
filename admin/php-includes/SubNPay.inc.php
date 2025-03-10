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


function checkSp_id (){
    
    global $cp_users_sp_id;
    
    if($cp_users_sp_id == 1){
        
            $Style = 'display: none;';
            echo $Style;
        
       } 

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


//linked with addsubject.fn.php
$ADDSUBJECT = addsubject();

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
$sql = "SELECT COUNT(subj_id) FROM cp_subjects";
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
$sql = "SELECT subj_id, subj_name, subj_classfee FROM cp_subjects $limit";

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
		$paginationCtrls .= '<li><a href="index.php?page=SubNPay&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=SubNPay&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=SubNPay&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=SubNPay&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=SubNPay&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=SubNPay&PageNo='.$last.'">&raquo;&raquo;</a></li>'
                         .'</ul>';
    }
}
    




 
?>



<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              View All Course
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
                <h3 class="box-title">All Courses, Payments &AMP; Allocations</h3>
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
             
         <!-- Search Form -->       
                       
                <form style="margin-bottom: 10px;" role="form" method="get" action="" class="form-inline">
                    <input type="hidden" name="page" value="SubNPay">
                    <input style="margin-top: 10px; width: 220px" class="form-control" type="text" name="SearchKey" value="<?php echo $_GET['SearchKey']; ?>" placeholder="Course ID or Name"/>
                    <input style="margin-top: 10px;" class="btn btn-primary btn-flat" type="submit" onclick="" value="Search">
                    <a style="margin-top: 10px;" href="index.php?page=SubNPay&PageNo=1" class="btn btn-success btn-flat" >View All</a>
                    <a style="margin-top: 10px;" href="index.php?page=ViewAllAllowStudents&PageNo=1" class="btn btn-info btn-flat" >View All Allocated Students</a>
                    <button style="margin-top: 10px;" type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#changeMsg">Add Course</button>                

                </form>
             
 <form name="addSubjectForm" action="" method="post">                
 <!-- Modal Window for Add Course-->
<div class="modal fade modal-danger" id="changeMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Course</h4>
      </div>
      <div class="modal-body">
         
          <div style="display: none;" class="form-group">
                      <label>Course ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="" name="txt_subj_id" placeholder="AUTO" class="form-control" readonly>
                       </div>
                    </div>


                     <div class="form-group">
                          <label>Course Name (Enter a short name or course code)</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="" name="txt_subj_name" class="form-control">
                       </div>

                    </div>
                  
                     <div class="form-group">
                          <label>Course Description</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="" name="txt_subj_des" class="form-control">
                       </div>

                    </div>  
          
                     <div class="form-group">
                          <label>Course Fee</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text" value="" name="txt_subj_fee" class="form-control">
                       </div>

                    </div>          
          
         
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>
        <input  style="" class="btn  btn-success btn-flat" type="submit" onclick="" name="btn_submit_addSubject" value="Add this Course">
      
      </div>
       
    </div>
  </div>
</div>                 
</form>
         
         
 <?php
 //If Search runs
 if(!isset($_GET["SearchKey"])){

 ?>
                    <form name="myform" action="" method="post">
                        <div class="box-body table-responsive no-padding">
                    <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course Fee</th>

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
                          <td>
                               
                                <a style="<?php checkSp_id (); ?>" href="index.php?page=ViewSubjectAllocatedStudents&SubjectID=<?php echo $row['subj_id']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                <i class="fa fa-users"></i> View Students
                                </a>                          
                              
                                <a style="<?php checkSp_id (); ?>" href="index.php?page=ViewAllPayments&SubjectID=<?php echo $row['subj_id']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                <i class="fa fa-usd"></i> View Payments
                                </a>  
                              
                                <a href="index.php?page=EditSubject&SubjectID=<?php echo $row['subj_id']; ?>" class="btn btn-app ">
                                <i class="fa fa-edit"></i> Edit
                                </a>  
                          </td>
                        
                         <td><?php echo $row['subj_id']  ?></td>
                         <td><?php echo $row['subj_name'] ?></td>
                         <td><?php echo $row['subj_classfee']  ?></td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                   
                     
                  </table> 
              </div>
    </form> 
                        <div style="margin-top: 5px;" class="pull-right" id="pagination_controls"><?php echo $paginationCtrls; ?> </div> 
                  



 <?php
                   
                   
               
                    } else {

                       $SearchKey =  $_GET["SearchKey"]; 

                       $sql_2 = "SELECT subj_id, subj_name, subj_classfee FROM cp_subjects WHERE subj_id LIKE '%{$SearchKey}%' OR subj_name LIKE '%{$SearchKey}%' ";
                       $query_2 = mysqli_query($db, $sql_2);

                   ?>
                                    
 <!-- Search Result Table -->                                    
<form name="myform2" action="" method="post">    
<div class="box-body table-responsive no-padding">
    <table id="vas_table2" class="table table-hover table-bordered table-responsive">      
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course Fee</th>

                      </tr>
                    </thead>
                    <tbody>

                        <?php

                        $PNo = $_GET["PageNo"];  
                        
                            // Loop to generate database values to table...       
                           while($row = mysqli_fetch_array($query_2, MYSQLI_ASSOC))
                           {
                
                        ?>
                    
                        
                      <tr>
                          <td>
                               
                                <a style="<?php checkSp_id (); ?>" href="index.php?page=UpdateStudentDetails&StudentID=<?php echo $row['stu_studentID']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                <i class="fa fa-users"></i> View Students
                                </a>                          
                              
                                <a style="<?php checkSp_id (); ?>" href="index.php?page=ViewAllPayments&StudentID=<?php echo $row['stu_studentID']; ?>&PageNo=<?php echo $PNo; ?>" class="btn btn-app ">
                                <i class="fa fa-usd"></i> View Payments
                                </a>  
                              
                                <a href="index.php?page=EditSubject&SubjectID=<?php echo $row['subj_id']; ?>" class="btn btn-app ">
                                <i class="fa fa-edit"></i> Edit
                                </a>  
                          </td>
                        
                         <td><?php echo $row['subj_id']  ?></td>
                         <td><?php  echo $row['subj_name'] ?></td>
                         <td><?php echo $row['subj_classfee']  ?></td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                   
                    
                  </table> 
</div>
   </form>  
                                                       
                                    
              <?php
              }
              ?>

                          
                  
                           <?php

                           // Close your database connection and Other Connections...
//                           $stmt->close();
//                           $stmt1->close();
                           $db->close();
                           mysqli_close($db);
                            
                           ?>
                    
                    

                                    
                                    
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 

<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
?>


    