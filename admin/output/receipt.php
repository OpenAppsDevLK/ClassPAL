<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
include_once '../php-includes/connect.inc.php';   

    $receiptid = $_GET['ReceiptNo'];

    //This will show the course details
    $stmt = $db->prepare("SELECT pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total, pay_misc_pay_description, pay_misc_amount FROM `cp_payments` WHERE pay_id=$receiptid");
    $stmt->bind_result($pay_paymentdate, $pay_paymentmonth, $pay_cos_fee, $pay_cos_admi, $pay_cos_total, $pay_misc_pay_description, $pay_misc_amount);
    $stmt->execute();

 while ($stmt->fetch()){
     $pay_cos_fee = number_format($pay_cos_fee, 2, '.', ''); 
     $pay_cos_admi = number_format($pay_cos_admi, 2, '.', ''); 
     $pay_cos_total = number_format($pay_cos_total, 2, '.', ''); 
     
     $pay_misc_amount = number_format($pay_misc_amount, 2, '.', ''); 
     
 }
?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Receipt</title>
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
  <body onload="window.print();" >
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-file-text-o"></i> Student Receipt
              <small class="pull-right">Date: <?php echo $pay_paymentdate; ?></small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            Receipt To
            <address>
                Student ID  : <strong><?php echo $_GET['StudentID'] ?></strong><br>
                Student Name: <strong><?php echo $_GET['StudentName'] ?></strong><br>
                <br>
                Receipt No  : <b><?php echo $_GET['ReceiptNo'] ?> </b><br>
                Paid Date   : <b> <?php echo $pay_paymentdate; ?></b><br>
                Paid Month  : <b><?php echo $pay_paymentmonth; ?></b><br>
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            
            
          </div><!-- /.col -->
        </div><!-- /.row -->

        <hr>
        <br>
        
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Course Name</th>
                  <th>Course Fee (Rs)</th>
                  <th>Admission (Rs)</th>
                  <th>Total (Rs)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $_GET['SubjName'] ?></td>
                  <td><?php echo $pay_cos_fee;  ?></td>
                  <td><?php echo $pay_cos_admi; ?></td>
                  <td><?php echo $pay_cos_total; ?></td>
                </tr>
              </tbody>
            </table>
              
              
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Misc. Payment Des.</th>
                  <th>Misc. Payment Amt. (Rs)</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $pay_misc_pay_description; ?></td>
                  <td><?php echo $pay_misc_amount; ?></td>
                </tr>
              </tbody>
            </table>              
              
              
              
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        
        <div class="row">      
          <div class="col-xs-6">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th>Total:</th>
                  <?php
                    
                        $receiptTotal = $pay_cos_total + $pay_misc_amount;
                        $receiptTotal = number_format($receiptTotal, 2, '.', ''); 
                  
                  ?>
                  <td><?php echo $receiptTotal; ?>
                      <br> Thank you for your payment!
                  
                  </td>
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