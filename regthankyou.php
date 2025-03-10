<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);


require_once 'admin/php-includes/connect.inc.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OraAcademy | New Student Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

                <!-- Sweet Alert Class-->
                <script src="plugins/sweetalert/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="background-color: #ab200f;" class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
      <a href="#" style="color: white"><b>New Student </b>Registration</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new student</p>

<?php
    $stmt_select_En_Dis_Stu_Regis_settings = $db->prepare("SELECT setting_id, Enable_Disable_Stu_Reg FROM `cp_settings` WHERE `setting_id`=3 ");
    $stmt_select_En_Dis_Stu_Regis_settings->bind_result($setting_id_ed_sr, $Enable_Disable_Stu_Reg);
    $stmt_select_En_Dis_Stu_Regis_settings->execute();


        while ($stmt_select_En_Dis_Stu_Regis_settings->fetch()){

            if ($Enable_Disable_Stu_Reg === 0){

                echo "<center>New Student Registration Closed.</center>";
                $dis_none = "none";

            } else {


            }

        }

?>

<script language="javascript" type="text/javascript">
function windowClose() {
    window.location = 'https://www.google.com/'
}
</script>

<center>
<h3>Thank you for your registration.</h3>
<h3>Your Student ID: <?php echo $_GET['StudentID']; ?></h3>
<h4>ඔබේ ශිෂ්‍ය හැඳුනුම් අංකය</h4>
<br>
<br>
    <h4>Bye... Have a nice day! </h4>
    <button onclick="windowClose()"  class="btn btn-danger btn-block btn-flat">EXIT</button>
</center>

  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
