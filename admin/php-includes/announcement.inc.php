<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...       
$stmt1126 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1126" ); 
$stmt1126->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1126->execute();

while ($stmt1126->fetch()){ 
    
}

//linked with announcement.fn.php
$ADDANNOUS = addannouncement();
$UPDATEANNOUS = updateannouncement();


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
$sql = "SELECT COUNT(id) FROM cp_announcements";
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
$sql = "SELECT id, an_title, an_des, an_date  FROM `cp_announcements` ORDER BY an_date DESC $limit";

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
		$paginationCtrls .= '<li><a href="index.php?page=AddAnnouncement&PageNo=1">&laquo;&laquo;</a></li>'
                                 .'<li><a href="index.php?page=AddAnnouncement&PageNo='.$previous.'">&laquo;</a></li>';
                         
		// Render clickable number links that should appear on the left of the target page number
		for($i = $pagenum-2; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="index.php?page=AddAnnouncement&PageNo='.$i.'">'.$i.'</a></li>';
			}
	    }
    }
    
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active" ><a href="#">'.$pagenum.'</a></li> ';
        
        
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="index.php?page=AddAnnouncement&PageNo='.$i.'">'.$i.'</a></li>';
		if($i >= $pagenum+2){
			break;
		}
	}
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li><a href="index.php?page=AddAnnouncement&PageNo='.$next.'">&raquo;</a></li> '
                         .'<li><a href="index.php?page=AddAnnouncement&PageNo='.$last.'">&raquo;&raquo;</a></li>'
                         .'</ul>';
    }
}
    




 
?>

<?php

if (isset($_GET['AnnouncementID'])){
    $varAnnouncementID = $_GET['AnnouncementID'];
   
         
    $stmtAnnouncementID = $db->prepare("SELECT id, an_date, an_title, an_des FROM `cp_announcements` WHERE `id`= $varAnnouncementID ");
    $stmtAnnouncementID->bind_result($Annoid, $Annoan_date, $Annoan_title, $Annoan_des);
    $stmtAnnouncementID->execute();
    

    
    while ($stmtAnnouncementID->fetch()){ 
        
    }   
   
    $buttonState = "disabled";
    $NewButton = "<input  style='margin-top: 5px;' class='btn  btn-success btn-lg' type='submit' onclick='' name='btn_Update_submit' value='Update Announcement'>";
    
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
            Announcements
            <small>You can add Announcement to the students form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tools</a></li>
            <li class="active">Announcements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Announcement</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Announcement Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form id="form_addstudent" role="form" action="<?php $ADDANNOUS;  ?>" method="post" enctype="multipart/form-data" >
                    <!-- text input -->
                    
                    <div class="form-group">
                      <label>ID</label>
                      <input type="text" name="txt_AutoID" value="<?php echo $Annoid;  ?>" class="form-control" placeholder="AUTO" readonly>
                    </div>
                    
                    <div class="form-group">
                      <label>Date</label>
                      <input type="date" name="txt_AutoDate" value="<?php echo $Annoan_date;  ?>" class="form-control">
                    </div>
                    

                    <div class="form-group">
                      <label>Title</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                           <input type="text" name="txt_Announcement_title" value="<?php echo $Annoan_title;  ?>" class="form-control" required>
                       </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Description</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>                       
                            <textarea class="form-control" name="txt_Announcement_description" rows="10"><?php echo $Annoan_des;  ?></textarea>                       
                       </div>
                    </div>

   
           
           
             
           <div class="box-footer">
              
                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" name="btn_submit" value="Add Announcement" <?php echo $buttonState; ?>> 
                <?php echo $NewButton; ?>                    
                <input style="margin-top: 5px;" class="btn  btn-primary" type="reset" value="New" <?php echo $buttonState; ?>>
                </div>
            
                    
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->

        </section><!-- /.content -->
        
        
        
                <!-- Annousments content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View All Announcements</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Announcement List</h3>
                </div><!-- /.box-header -->
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
              <div class="" id="pagination_controls"><?php echo $paginationCtrls; ?> </div>                     
                <div class="box-body table-responsive no-padding">
                <table id="vas_table" class="table table-hover table-bordered">

                    <thead>
                      <tr>
                          
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                     while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))

                             
                    {
                      
                        
                        ?>
                                   
                      <tr>
                        <td style="text-align:right" >
                            <?php echo $row['id']; ?>
                        </td>
                        <td><?php echo $row['an_title']; ?></td>
                        <td style="width: 500px" ><?php echo $row['an_des']; ?></td>
                        <td><?php echo $row['an_date']; ?></td>
                        <td>   
                            <a style="margin-top: 5px;" href="index.php?page=AddAnnouncement&AnnouncementID=<?php echo $row['id']; ?>" class="btn  btn-primary"><span class="fa fa-edit"></span></a>                        
                            <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $row['id']; ?>"><span class="fa fa-remove"></span></button> 
                        </td>

                      </tr>

      <!-- Modal -->
<div class="modal fade modal-danger" id="<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove Announcement</h4>
      </div>
      <div class="modal-body">
          Do you want to delete this Announcement... ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">No</button>
        <a  href="actions/deleteannouncement.php?AnnouncementID=<?php echo $row['id']; ?>" class='btn btn-success btn-flat'>Yes</a>
      </div>
    </div>
  </div>
</div>
                    
                   <?php
                   
                   }
                   
                   ?>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                          
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                        
                      </tr>
                    </tfoot>
 
                  </table>
                   
            </div><!-- /.box-body -->
            

 
            
          </div><!-- /.box -->

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
