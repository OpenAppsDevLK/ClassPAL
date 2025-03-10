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
  <title>MAXMIND | New Student Registration</title>
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


<form id="form_addstudent"  action="" method="post" enctype="multipart/form-data" style="display: <?php echo $dis_none; ?>">

      <div class="form-group has-feedback">
        <input type="hidden" name="txt_AutoID" class="form-control">
      </div>

        <?php
//                    $a = mt_rand(100000,1000000);
//
//                    $AutoNuber = $a + 159357;
        ?>

      <div class="form-group has-feedback">
          <label>Student ID</label>
          <input type="text" name="txt_student_id" placeholder="Student ID" value="<?php echo $_GET['StudentID']; ?>" class="form-control" readonly>
        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
          <input type="hidden" name="txt_student_barcode"  class="form-control">
      </div>

      <div class="form-group has-feedback">
          <label>ලියාපදිංචි දිනය | Registration Date* (M:D:Y) </label>
          <input type="date" name="txt_regDate" value="<?php echo date('Y-m-d') ?>" class="form-control " readonly>
        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ශිෂ්‍යාගේ නම | Student Name*</label>
         <input type="text" name="txt_student_name" placeholder="උදා: W.C.C Kamal Kumara" class="form-control" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ලිපිනය | Address</label>
         <textarea class="form-control" name="txt_student_address" rows="3"></textarea>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ස්ත්‍රී පුර්ෂ භාවය | Sex</label>
            <select name="txt_student_sex" class="form-control">
             <option>Male</option>
             <option>Female</option>
            </select>
        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>උපන්දිනය | Birth Date (Y:M:D)</label>
         <input type="date" name="txt_BDate" placeholder="Date of birth" class="form-control">
        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ස්ථාවර දුරකථන අංකය | Home Phone Number</label>
         <input type="text" class="form-control" name="txt_student_hmphone">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ජංගම දුරකථන අංකය 01 | Mobile Number 01*</label>
         <input type="text" name="txt_student_Mno01" class="form-control" required>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ජංගම දුරකථන අංකය 02 | Mobile Number 02</label>
         <input type="text" class="form-control" name="txt_student_Mnub02">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ඊ මේල් ලිපිනය | Email</label>
         <input type="email" name="txt_student_email" class="form-control" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>ජාතික හැදුනුම්පත් අංකය | NIC | ID Number</label>
         <input type="text" name="txt_student_nic" class="form-control" >
        <span class="glyphicon glyphicon-folder-close form-control-feedback"></span>
      </div>

       <div class="form-group has-feedback">
         <label>පාසැල | School</label>
         <input type="text" name="txt_student_school" class="form-control" >
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>

                  <?php
                  $b = mt_rand(10000,100000);
                  ?>

       <div class="form-group has-feedback">
           <input type="hidden" value="<?php echo $b; ?>" name="txt_student_accesskey" class="form-control" >
      </div>

       <div class="form-group has-feedback">
           <input type="hidden" name="txt_AlloAutoID" class="form-control" >
      </div>


      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
            <button type="submit" name="btn_AddStu_submit" class="btn btn-danger btn-block btn-flat">ලියාපදිංචිවන්න | Register >> </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<?php

if(isset($_POST['btn_AddStu_submit'])){

    global $db;


    if (isset($_POST['txt_AutoID'])) {
           $var_AS_ID = $_POST['txt_AutoID'];
    }

    if (isset($_POST['txt_student_id'])) {
        $var_AS_StudentID =  $_POST['txt_student_id'];
    }

    if (isset($_POST['txt_regDate'])) {
    $var_AS_StuRegDate = $_POST['txt_regDate'];
    }

    if (isset($_POST['txt_student_name'])) {
    $var_AS_StuName = $_POST['txt_student_name'];
    }

    if (isset($_POST['txt_student_address'])) {
    $var_AS_StuAddress = $_POST['txt_student_address'];
    }

    if (isset($_POST['txt_student_sex'])) {
    $var_AS_StuSex = $_POST['txt_student_sex'];
    }

    if (isset($_POST['txt_BDate'])) {
    $var_AS_StuBday = $_POST['txt_BDate'];
    }


    if (isset($_POST['txt_student_hmphone'])) {
    $var_AS_HomePhone = $_POST['txt_student_hmphone'];
    }


    if (isset($_POST['txt_student_Mno01'])) {
    $var_AS_MobNo01 = $_POST['txt_student_Mno01'];

    }

    if (isset($_POST['txt_student_Mnub02'])) {
    $var_AS_MobNo02 = $_POST['txt_student_Mnub02'];

    }

    if (isset($_POST['txt_student_email'])) {
    $var_AS_StuEmail = $_POST['txt_student_email'];

    }


     if (isset($_POST['txt_student_nic'])) {
    $varStuNIC = $_POST['txt_student_nic'];

    }

    if (isset($_POST['txt_student_school'])) {
    $varStuSchool = $_POST['txt_student_school'];

    }

    if (isset($_POST['txt_student_accesskey'])) {
    $varStuAccessKey = $_POST['txt_student_accesskey'];

    }


        $UploadName = "df.jpg";

       global $db;

 
    $stmt2 = $db->prepare("INSERT INTO `cp_online_reg_stu` (stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_image_name, stu_nic, stu_school, stu_accesskey) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt2->bind_param('iissssssssssssi', $var_AS_ID, $var_AS_StudentID, $var_AS_StuRegDate, $var_AS_StuName, $var_AS_StuAddress, $var_AS_StuSex, $var_AS_StuBday, $var_AS_HomePhone, $var_AS_MobNo01, $var_AS_MobNo02, $var_AS_StuEmail, $UploadName, $varStuNIC, $varStuSchool, $varStuAccessKey);
    $stmt2->execute();
    $stmt2->close();



       //Redirect to the page after insert
      echo "<script> window.location = 'studentphoto.php?StudentID=$var_AS_StudentID'";
      echo "</script>";

    return($stmt3);

   }

?>










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
