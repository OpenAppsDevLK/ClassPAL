<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../php-includes/connect.inc.php';  



?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard MONTHLY INCOME CHART Fixer</title>
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
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-users"></i> Setting: Dashboard MONTHLY INCOME CHART Fixer
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
<?php

    $C_year = $_GET['c_year'];
    
    $varpay_month01 = $C_year.'01';

       //Used a prepared statment to update users to the database..)
    $stmt_mo1 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 1" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo1->bind_param('i', $varpay_month01);
    $stmt_mo1->execute();
    $stmt_mo1->close(); 
    
    $varpay_month02 = $C_year.'02';

       //Used a prepared statment to update users to the database..)
    $stmt_mo2 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 2" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo2->bind_param('i', $varpay_month02);
    $stmt_mo2->execute();
    $stmt_mo2->close();   
    
    
    $varpay_month03 = $C_year.'03';

    //Used a prepared statment to update users to the database..)
    $stmt_mo3 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 3" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo3->bind_param('i', $varpay_month03);
    $stmt_mo3->execute();
    $stmt_mo3->close();    
    
 
    $varpay_month04 = $C_year.'04';

    //Used a prepared statment to update users to the database..)
    $stmt_mo4 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 4" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo4->bind_param('i', $varpay_month04);
    $stmt_mo4->execute();
    $stmt_mo4->close();  
    
    $varpay_month05 = $C_year.'05';

    //Used a prepared statment to update users to the database..)
    $stmt_mo5 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 5" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo5->bind_param('i', $varpay_month05);
    $stmt_mo5->execute();
    $stmt_mo5->close();  
    
     $varpay_month06 = $C_year.'06';

    //Used a prepared statment to update users to the database..)
    $stmt_mo6 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 6" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo6->bind_param('i', $varpay_month06);
    $stmt_mo6->execute();
    $stmt_mo6->close();  
 
    
    $varpay_month07 = $C_year.'07';

    //Used a prepared statment to update users to the database..)
    $stmt_mo7 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 7" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo7->bind_param('i', $varpay_month07);
    $stmt_mo7->execute();
    $stmt_mo7->close();  
 
    $varpay_month08 = $C_year.'08';

    //Used a prepared statment to update users to the database..)
    $stmt_mo8 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 8" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo8->bind_param('i', $varpay_month08);
    $stmt_mo8->execute();
    $stmt_mo8->close(); 

    $varpay_month09 = $C_year.'09';

    //Used a prepared statment to update users to the database..)
    $stmt_mo9 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 9" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo9->bind_param('i', $varpay_month09);
    $stmt_mo9->execute();
    $stmt_mo9->close(); 

    $varpay_month10 = $C_year.'10';

    //Used a prepared statment to update users to the database..)
    $stmt_mo10 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 10" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo10->bind_param('i', $varpay_month10);
    $stmt_mo10->execute();
    $stmt_mo10->close();
 
    
    $varpay_month11 = $C_year.'11';

    //Used a prepared statment to update users to the database..)
    $stmt_mo11 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 11" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo11->bind_param('i', $varpay_month11);
    $stmt_mo11->execute();
    $stmt_mo11->close();

    $varpay_month12 = $C_year.'12';

    //Used a prepared statment to update users to the database..)
    $stmt_mo12 = $db->prepare("UPDATE cp_payments SET pay_paymentmonth=? WHERE `pay_id`= 12" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt_mo12->bind_param('i', $varpay_month12);
    $stmt_mo12->execute();
    $stmt_mo12->close();
    
    
    
?>
        <!-- Table row -->
        <div class="row">
            
                <?php
                               
                                $stmtpaymonth = $db->prepare("SELECT pay_paymentmonth FROM `cp_payments` WHERE `pay_id`= 12");
                                $stmtpaymonth->bind_result($stmtSelectPayMonth);
                                $stmtpaymonth->execute();    
                                
                                
                                             while ($stmtpaymonth->fetch()){

                                                }
             
                                
                                if ($stmtSelectPayMonth == $varpay_month12) {
                                    
                                    echo "Dashboard MONTHLY INCOME CHART Fixed Successfully..!!!";
                                    
                                } else {
                                    
                                    echo "Operation Failed, Try Again or Contact DilMAX-IT Support";
                                }
                  ?>
            
              <a style="margin-bottom: 10px;" href="#" onclick="window.top.close();" class="btn btn-primary" >Close Window</a>
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