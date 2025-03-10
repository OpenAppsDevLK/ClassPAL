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
    <p class="login-box-msg"> Upload your photo</p>

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

<form action="" name="student_photo" id="myform" method="post" enctype="multipart/form-data" style="display: <?php echo $dis_none; ?>">



      <div class="form-group has-feedback">
          <label>Student ID</label>
          <input type="text" name="txt_student_id" placeholder="Student ID" value="<?php echo $_GET['StudentID']; ?>" class="form-control" readonly>
        <span class="glyphicon glyphicon-info-sign form-control-feedback"></span>
      </div>


      <div class="form-group has-feedback">
          <label>Choose your photo (ඔබගේ චායාරුපයක් ලබා දෙන්න.) ඔබ selfie චායාරුපයක් ලබගන්නේ නම්, ඔබගේ ජංගම දුරකථනය landscape (දිග අතට) අතට හරවා ගන්න.</label>
          <center><img style="margin-top:20px; margin-bottom: 20px;" src="img/rotate.jpg"></center>
          <label>ඔබගේ චායාරුපය ලබාදීම සදහා [Choose File] ක්ලික් හෝ ටච් කරන්න. ඉන්පසු ඔබගේ චයරුපය ලබාදී, [Upload your photo ] බොත්තම මත  ක්ලික් හෝ ටච් කර මදක් රැදී සිටින්න.</label>
          <input style="border-color: red;" type="file" name="file"  class="form-control" id="file" required/>
      </div>




      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">

            <button type="submit" onclick="textchange();" id="btnAddProfile" name="btn_photo_submit" class="btn btn-danger btn-block btn-flat">Upload Your Photo</button>

            <script>
               function textchange(){

                      $("#btnAddProfile").html('Please Wait, your photo is uploading...');

                 };


            </script>
        </div>
        <!-- /.col -->
      </div>
    </form>

<?php
include_once 'php-includes/connect.inc.php';

	$name = ''; $type = ''; $size = ''; $error = '';
	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);

    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}

	if ($_POST) {

    		if ($_FILES["file"]["error"] > 0) {
        			$error = $_FILES["file"]["error"];
    		}
    		else if (($_FILES["file"]["type"] == "image/gif") ||
			($_FILES["file"]["type"] == "image/jpeg") ||
			($_FILES["file"]["type"] == "image/png") ||
			($_FILES["file"]["type"] == "image/pjpeg")) {


                                 $Rmub = rand(100,10000);
                                $Student_ID = $_GET['StudentID'];

        			$url ='admin/Upload/studentphotos/' . $Student_ID . '_' . $Rmub . '_photo.jpg';
                                $imageFileName = $Student_ID . '_' . $Rmub . '_photo.jpg';

        			$filename = compress_image($_FILES["file"]["tmp_name"], $url, 10);
                                header("Content-Disposition: filename=$url");

        			/* Send our file... */
        			echo $buffer;
        			//echo $url;

 global $db;

    $stmt = $db->prepare("UPDATE cp_online_reg_stu SET stu_image_name=? WHERE `stu_studentID`='$Student_ID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('s', $imageFileName);
    $stmt->execute();
    $stmt->close();


                                echo '<script>
                                setTimeout(function() {
                                    swal({
                                        title: "Good job!!",
                                        text: "You just uploaded your photo! Thank you!",
                                        type: "success"
                                    }, function() {
                                        window.location = "regthankyou.php?StudentID='.$Student_ID.'";
                                    });
                                }, 1000);
                            </script>';

    		}else {
        			$error = "Uploaded image should be jpg or gif or png";
    		}
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
