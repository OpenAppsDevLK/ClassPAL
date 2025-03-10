<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

// Select the user and assign permission...        
$stmt1113 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1113" ); 
$stmt1113->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1113->execute();

while ($stmt1113->fetch()){ 
    
}


//linked with addpayment.fn.php
$ADDPAYMENT = addpayment();


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
           Add Payment
            <small>You can add students payments form here...</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Students</a></li>
            <li><a href="#">View All Students</a></li>
            <li class="active">Add Payment</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student Payment</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
             
           <!-- general form elements disabled -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Student Payment Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                    
                 <?php 

                    //This will show the subject details
                    $stmt5 = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects`");
                    $stmt5->bind_result($Subj_id, $Subj_Name, $subj_Fee);
                    $stmt5->execute();

                  ?>
                   
                       
                    <div class="form-group has-error">
                      <label>Select the Course Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-file-text-o"></i>
                      </div> 
                     
                      <form name="form1" id="form_addsubject" role="form" action="" method="get">
                      <select class="form-control" name="jumpmenu" onChange="jumpto(document.form1.jumpmenu.options[document.form1.jumpmenu.options.selectedIndex].value)">
                         <option value="" disabled selected><?php echo $_GET['SubjID'] . " ". $_GET['SubjName'] ?></option>
                          <?php
                          
                          //All the subject will load to the dropdown box and the selected dropdown value will execute a browser URL as a output....
                          if (isset($_GET['SubjID'])){
                              $Subj_id = $_GET['SubjID'];
                              $Subj_Name = $_GET['SubjName'];
                              
                          }
                          
                          
                          while ($stmt5->fetch()){
                              
                          
                         ?>
                         <option value="index.php?page=AddPayment&StudentID=<?php echo $_GET['StudentID'] ?>&StudentName=<?php echo $_GET['StudentName'] ?>&PageNo=<?php echo $_GET['PageNo'] ?>&ReceiptNo=<?php echo $_GET['ReceiptNo'] ?>&SubjID=<?php echo $Subj_id  ?>&SubjName=<?php echo $Subj_Name;  ?>&SubjFee=<?php echo $subj_Fee;  ?>"> <?php echo $Subj_id ." ". $Subj_Name; ?></option>

                        <?php
                        }
                        ?>
                      </select>
                              
                      </form>
                      </div>
                    </div>
                    
                    <hr>
                    
                    <form id="form_studentpayment" name="form_studentpayment" role="form" action="<?php $ADDPAYMENT;  ?>" method="post" enctype="multipart/form-data" >      
                      <!-- text input -->
                   <?php
                                //This will show institutes
                                $stmtIns = $db->prepare("SELECT ins_id, ins_name FROM `cp_ins`");
                                $stmtIns->bind_result($ins_ID, $ins_Name);
                                $stmtIns->execute();                  
                  ?>
                      
                      <div style="display: none;"class="form-group has-error">
                      <label>Branch Name</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                      </div>                       

                      <select name="txt_Institue_name" class="form-control">
                      
                      
                          <?php
                               
                              while ($stmtIns->fetch()){

                           ?>
                          
                          <option value="<?php echo $ins_Name; ?>"><?php echo $ins_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                              
                        
                        ?>
                       
                      </select>
                      </div>
                    </div> 
                    <div class="form-group">
                      <label>Receipt No</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-star "></i>
                     </div>
                      <input type="text" value="<?php echo $_GET['ReceiptNo']; ?>" name="txt_RecpID" class="form-control" placeholder="AUTO" readonly>
                      </div>
                      
                    
                    <div class="form-group">
                      <label>Student ID</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['StudentID'] ?>" name="txt_student_id" class="form-control" readonly>
                       </div>
                    </div>
                      
                      
                    <div class="form-group ">
                          <label>Student Name</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-info"></i>
                        </div>
                        <input type="text"  value="<?php echo $_GET['StudentName']; ?>" name="txt_student_name" class="form-control">
                       </div>

                    </div>
                      
                    <div class="form-group">
                      <label>Course Name</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-file-text-o"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['SubjID']." ". $_GET['SubjName']; ?>" name="txt_subject_id" value="<?php echo $AS_Student_ID; ?>" class="form-control" readonly>
                       </div>
                    </div>     
                      
                    <div class="form-group">
                      <label>Batch Number</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-file-text-o"></i>
                        </div>                       
                           <input type="text" value="<?php echo $_GET['BatchID']; ?>" name="txt_batch_nub" value="<?php echo $_GET['BatchNo']; ?>" class="form-control">
                       </div>
                    </div>                                          
                      
                  
                 <div class="form-group has-error">
                    <label>Payment Date [Mob:(D:M:Y) | PC:(M:D:Y)]</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="txt_payDate" class="form-control ">
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  
                                    
                    <div class="form-group has-error">
                      <label>Payment Month (Ex: 202101)</label>
                       <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-align-justify"></i>
                        </div>
                           <input type="number" style="font-size: 20px; font-weight: bold;" value="<?php echo date('Ym'); ?>" class="form-control" name="txt_student_paymonth" autofocus>                       
                       </div>
                    </div>
                  

                            

                  <div class="nav-tabs-custom" style="background-color: #00A65A">
            <ul class="nav nav-tabs" >
              <li class="active"><a style="color: black; font-weight: bold;" href="#tab_1" data-toggle="tab" aria-expanded="true">Course Payments</a></li>
              <li class=""><a style="color: black; font-weight: bold;" href="#tab_2" data-toggle="tab" aria-expanded="false">Misc. Payments</a></li>
            </ul>
            <div class="tab-content" style="background-color: #00A65A">
              <div class="tab-pane active" id="tab_1">

                            <?php 

//                                 $suj_ID = $_GET['SubjID'];
//                                //Select the database Subject Fee
//                               $stmt_select_subjfee = $db->prepare("SELECT subj_id, subj_name, subj_classfee FROM `cp_subjects` WHERE `subj_id`=$suj_ID");
//                               $stmt_select_subjfee->bind_result($Subj_id, $Subj_Name, $subj_Fee);
//                               $stmt_select_subjfee->execute();

                            ?>

                                 <div class="form-group">
                                <label>Paid Amount</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                    <input type="number" style="font-size: 30px; font-weight: bold;" value="<?php  //while ($stmt_select_subjfee->fetch()){ echo $subj_Fee; };   ?>" class="form-control" name="txt_student_subjfee" data-cell="A1" data-format=" 0,0[.]00" placeholder="0.00">
                                </div><!-- /.input group -->
                              </div><!-- /.form group -->               


                              <div class="form-group">
                                <label>Admission</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                    <input type="number" style="font-size: 30px; font-weight: bold;" value="" name="txt_student_admission" class="form-control" data-cell="A2" data-format=" 0,0[.]00" placeholder="0.00">
                                </div><!-- /.input group -->
                              </div><!-- /.form group -->

                              <div class="form-group">
                                <label>Total</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-money "></i>
                                  </div>
                                    <input type="number" style="font-size: 30px; font-weight: bold;" class="form-control" value="" name="txt_student_total" data-formula="A1+A2"  placeholder="0.00">
                                </div><!-- /.input group -->
                              </div><!-- /.form group -->

                                     <!-- This code is for calulate forms values.  -->
                                       <script type="text/javascript">
                                            $('#form_studentpayment').calx();
                                        </script>                     

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                  
                            <div class="form-group">
                                <label>Description </label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                  </div>
                                    <input style="font-size: 30px; font-weight: bold;" type="text" value="" class="form-control" name="txt_mics_description">
                                </div><!-- /.input group -->
                              </div><!-- /.form group -->   
                              
                              
                              <div class="form-group">
                                <label>Amount</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-money "></i>
                                  </div>
                                    <input style="font-size: 30px; font-weight: bold;" type="number" class="form-control" value="" name="txt_mics_amount">
                                </div><!-- /.input group -->
                              </div><!-- /.form group -->                              

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
                            
        </form>      
           <div class="box-footer">
                <?php
                   //To generate payment ID
                   $ReceiptNo =  rand();
                   
                   if (isset($_GET['PageNo'])){
                       $GotoPage = "index.php?page=ViewAllStudents&PageNo={$_GET['PageNo']}";
                   }  else {
                       
                       $GotoPage = "index.php?page=ViewAllStudents&PageNo=1";
                        
                   }
                ?>

               

                <div class= "col-lg-6 col-md-12 col-xs-1">
                <input  style="margin-top: 5px;" class="btn  btn-success btn-lg" type="submit" onclick="" value="Add Payment [F2]">
                <a style="margin-top: 5px;" target="_blank" href="output/receipt.php?StudentID=<?php echo $_GET['StudentID']; ?>&StudentName=<?php echo $_GET['StudentName']; ?>&ReceiptNo=<?php echo $_GET['ReceiptNo']; ?>&SubjID=<?php echo $_GET['SubjID']; ?>&SubjName=<?php echo $_GET['SubjName']; ?>" class="btn  btn-primary">Print Receipt</a>
                <a style="margin-top: 5px;" href="index.php?page=AddPayment&StudentID=<?php echo $_GET['StudentID']; ?>&StudentName=<?php echo $_GET['StudentName']; ?>&PageNo=<?php echo $_GET['PageNo']; ?>&ReceiptNo=<?php echo $ReceiptNo; ?>" class="btn  btn-primary">New Payment</a>
                <a style="margin-top: 5px;" href="<?php echo $GotoPage; ?>"  class="btn btn-danger">View All Students</a>
                <!-- <button style="margin-top: 5px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">View All Students</button> -->
                </div>
            
          

<script>

//If Javascript to run the Keypress
$(function(){
    //Yes! use keydown 'cus some keys is fired only in this trigger,
    //such arrows keys
    $("body").keydown(function(e){
         //now we caught the key code, yabadabadoo!!
         var keyCode = e.keyCode || e.which;

            if ((e.which || e.keyCode) == 113) {
                
                    //well you need keep on mind that your browser use some keys 
                    //to call some function, so we'll prevent this
                    e.preventDefault();
                    
                    //Triger the submit form after press the key
                    document.form_studentpayment.submit();
                        
                        //Window will reload after sumit
                        window.onload = function() {
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                     };
        }
         //your keyCode contains the key code, F1 to F12 
         //is among 112 and 123. Just it.
         console.log(keyCode); //You can see the ouput log on browser console  
    });
});


</script>               
               
               
               
            </div><!-- /.box-footer-->   
                     
            </form>      
            </div><!-- /.box-body -->
            

          </div><!-- /.box -->
          Only Show 10 Payments. 
  <div class="box-body table-responsive no-padding">
                  
                   
                   <table id="vas_table" class="table table-hover table-bordered table-responsive">
                         
                         
                    <thead>
                      <tr>
                        <th>Pay ID</th>
                        <th>Course Name</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Amount</th>
                        <th>Misc. Payment Des.</th>
                        <th>Misc. Payment Amt.</th>
                        <th>Action</th>
                        

                      </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $Student_ID = $_GET['StudentID'];
                        $SubjID = $_GET['SubjID'];
                        $SubjName = $_GET['SubjName'];

                        $stmt = $db->prepare("SELECT pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total, pay_misc_pay_description, pay_misc_amount FROM `cp_payments` WHERE Pay_stu_studentID= $Student_ID AND pay_subj_id=$SubjID ORDER By pay_paymentdate DESC  LIMIT 10") ;
                        $stmt->bind_result($adp_pay_id, $adp_Pay_stu_studentID, $adp_pay_student_name, $adp_pay_subj_id, $adp_pay_paymentdate, $adp_pay_paymentmonth, $adp_pay_cos_fee, $adp_pay_cos_admi, $adp_pay_cos_total, $pay_misc_pay_description, $pay_misc_amount);
                        $stmt->execute();

                        while ($stmt->fetch()){
  
  
      
                
                        ?>
                    
                        
                      <tr>
                        
                         <td><?php echo $adp_pay_id;  ?></td>
                         <td><?php  echo $SubjName; ?></td>
                         <td><?php echo $adp_pay_paymentdate;  ?></td>
                         <td><?php echo $adp_pay_paymentmonth;  ?></td>
                         <td><?php echo $adp_pay_cos_total;  ?></td>
                         <td><?php echo $pay_misc_pay_description;  ?></td>
                         <td><?php echo $pay_misc_amount;  ?></td>
                         <td>
                             <a style="margin-top: 5px;" target="_blank" href="index.php?page=ViewAllPayments&SubjectID=<?php echo $adp_pay_subj_id; ?>&SearchKey=<?php echo $adp_Pay_stu_studentID; ?>" class="btn  btn-danger"><span class="fa fa-times-circle-o"></span></a>                            
                             
                         </td>
                         
                      

                      </tr>
                      <?php } ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Pay ID</th>
                        <th>Course Name</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Amount</th>
                        <th>Misc. Payment Des.</th>
                        <th>Misc. Payment Amt.</th> 
                        <th>Action</th>
                        
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
               

               
              
               
               
            </div><!-- /.box-footer-->  
            
        </section><!-- /.content -->
        <?php   
        
           }  
        ?> 
      </div><!-- /.content-wrapper -->


<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
?>