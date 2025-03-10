<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


include_once '../php-includes/connect.inc.php';   



    $date01 = $_GET['date01'];
    $date02 = $_GET['date02'];
    
    
$stmt_sel_Rows = $db->prepare("SELECT COUNT(pay_id) FROM cp_payments WHERE pay_paymentdate BETWEEN '$date01' AND '$date02'");
$stmt_sel_Rows->bind_result($TotalRows);
$stmt_sel_Rows->execute();

while ($stmt_sel_Rows->fetch()){

    
}  


// Select the user and assign permission...          
$stmt_select_sp_user = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} " ); 
$stmt_select_sp_user->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt_select_sp_user->execute();

while ($stmt_select_sp_user->fetch()){ 
    
}


 if($cp_users_sp_id == 1){
     $show = ceil($TotalRows / 2);
 } else {
     $show = $TotalRows;
 }
 
 

    //This will show the Student details
    $stmt = $db->prepare("SELECT Pay_stu_studentID, pay_student_name, pay_subj_id, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total, pay_misc_pay_description, pay_misc_amount FROM `cp_payments` WHERE pay_paymentdate BETWEEN '$date01' AND '$date02' ORDER BY pay_paymentdate DESC LIMIT $show");
    $stmt->bind_result($Pay_stu_studentID, $pay_student_name, $pay_subj_id, $pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total, $pay_misc_pay_description, $pay_misc_amount);
    $stmt->execute();


?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Range Income</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <!-- onload="window.print();" -->
  <body onload="window.print();">
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-usd"></i> Report: Range Income | From <?php echo $date01; ?> To <?php echo $date02; ?>
              <small class="pull-right">Report Created Date: <?php echo date('Y-m-d'); ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table id="vas_table" class="table table-hover table-bordered table-responsive">

                         
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Course Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                        <th>Misc. Payments Description</th>
                        <th>Misc. Amount</th>                        
                      </tr>
                    </thead>
                    <tbody>


                    <?php
                     while ($stmt->fetch()){
                    ?>
                        
                        
                      <tr>


                        
                        <td><?php echo $Pay_stu_studentID; ?></td>
                        <td><?php echo $pay_student_name;  ?></td>
                        <td><?php echo $pay_subj_id; ?></td>
                        <td><?php echo $pay_paymentdate; ?></td>
                        <td><?php echo $pay_paymentmonth; ?></td>
                        <td><?php echo $pay_cos_fee ?></td>
                        <td><?php echo $pay_cos_admi;  ?></td>
                        <td><?php echo $pay_cos_total; ?></td>
                         
                        <td><?php echo $pay_misc_pay_description;  ?></td>
                        <td><?php echo $pay_misc_amount; ?></td>                         
                      

                      </tr>
                   <?php
                     }  
                   
                   ?>
                      
                   </tbody>
                   
                     <tfoot>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course ID</th>
                        <th>Payment Date</th>
                        <th>Payment Month</th>
                        <th>Course Fee</th>
                        <th>Admission</th>
                        <th>Total</th>
                        <th>Misc. Payments Description</th>
                        <th>Misc. Amount</th>                         
                      </tr>
                                    
                    </tfoot>
                     
                  </table> 
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
              <?php

               $stmt1 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate BETWEEN '$date01' AND '$date02' ORDER BY pay_paymentdate DESC");
               $stmt1->bind_result($TotalIncome);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                    if($cp_users_sp_id == 1){
                        
                        $ShowTotalIncome = ceil($TotalIncome / 2);
                        
                    } else {
                        $ShowTotalIncome = $TotalIncome;
                    }                  
            
                   
               }

            ?>
                    
                    <th>Total Income: <?php echo $ShowTotalIncome; ?></th>
                    
                    
            <?php
                // Get total Mis. income
               $stmt_Mise_income = $db->prepare("SELECT SUM(pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN '$date01' AND '$date02' ORDER BY pay_paymentdate DESC");
               $stmt_Mise_income->bind_result($TotalMiseIncome);
               $stmt_Mise_income->execute();

               while ($stmt_Mise_income->fetch()){
                $TotalMiseIncome = number_format($TotalMiseIncome, 2, '.', ''); 
                   
            }

            ?>
                    <th>Total Mise.Income: <?php echo $TotalMiseIncome; ?></th>                    
                    
                    
                    <th>Total Income: <?php echo $TotalIncome + $TotalMiseIncome; ?></th>   
                    
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
  </body>
</html>

<?php

// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


?>