<?php

// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


include_once 'php-includes/connect.inc.php';
require_once 'plugins/swm/lib/swift_required.php';


session_start();


?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ClassPAL | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
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

         <!-- Google ReCaptcha -->
 <script src='https://www.google.com/recaptcha/api.js'></script>


  </head>
  <body style="background-color: #ab200f;" class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
          <a style="color: white;" href="#">ClassPAL</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="padding-top: 40px;">

  <?php

    $stmt_select_login_page_settings= $db->prepare("SELECT setting_id, 	teacher_name, teacher_photo FROM `cp_settings` WHERE `setting_id`=4 ");
    $stmt_select_login_page_settings->bind_result($setting_id_login_page_st, $teacher_name, $teacher_photo);
    $stmt_select_login_page_settings->execute();


        while ($stmt_select_login_page_settings->fetch()){

        }

 ?>

        <p class="login-box-msg">
            <!-- src="Upload/df.jpg" -->
            <img  src="Upload/teacherphoto/<?php echo $teacher_photo; ?>"  class=" " id="Uploadimg" name="Uploadimg" style="width:100%;height:100%; border-radius: 10px;">

        </p>
        <h3 class="login-box-msg"><?php echo $teacher_name; ?></h3>
        <hr>

        <form action="" method="post">
          <div class="form-group has-feedback">
              <input type="text" name="txt-Name" class="form-control" placeholder="Enter User Name">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="txt-pass" class="form-control" placeholder="Enter Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>


           <div class=""  >
              <button type="submit" name="btn_login" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->


          <div class="row">



                    <?php




                //if submit button (name="btn-login") click, run this code...

  		if(isset($_POST['btn_login'])){





			if(empty($_POST['txt-Name'])){
					$error[] = "<div class='alert alert-danger alert-dismissable'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                    <h4><i class='icon fa fa-ban'></i> WARNING!</h4>
                                                     User name is missing
                                                    </div>";
					$name ='';
			}
			else {
				$name = mysqli_real_escape_string($db,trim($_POST['txt-Name']));
			}

			if(empty($_POST['txt-pass'])){
					$error[] = "<div class='alert alert-danger alert-dismissable'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                    <h4><i class='icon fa fa-ban'></i> WARNING!</h4>
                                                    Password is missing
                                                    </div>";
					$pass ='';
			}
			else {
				$pass = sha1(mysqli_real_escape_string($db,trim($_POST['txt-pass'])));
			}



				$sql = "SELECT * FROM cp_users WHERE username = '{$name}' AND password = '{$pass}' LIMIT 1";
				$result = mysqli_query($db,$sql);




				if(mysqli_num_rows($result) == 1){
					$user = mysqli_fetch_array($result);
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['user_name'] = $user['username'];

                                        $userid = $user['id'];
                                        $username = $user['username'];
                                        $Logdate = date("Y-m-d");

                                        //TimeZone Configerations...
                                        $date = new DateTime('',new DateTimeZone('Asia/Colombo'));
                                        $date->setTimezone(new DateTimeZone('Asia/Colombo'));

                                        //$Logtime = date("h:i");


                                            //Used a prepared statment to add user log data to the database..)
                                         $stmt1 = $db->prepare("INSERT INTO `cp_logs` (userid, username, logdate, logtime) VALUES (?, ?, ?, ?)" );
                                         //i - integer / d - double / s - string / b - BLOB
                                         $stmt1->bind_param('isss', $userid, $username, $Logdate, $date->format('H:i:s'));
                                         $stmt1->execute();
                                         $stmt1->close();

                                        // Some servers header syntax not working,..Use this code if php header not working...
                                        //echo "<script>location='dash.php'</script>";


					header('Location: dash.php');
					exit();

				}

				else {

					$error[] = "<div class='alert alert-danger alert-dismissable'>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                                    <h4><i class='icon fa fa-ban'></i> WARNING!</h4>
                                                    User Name, Password or reCAPTCHA invalid, Try Again...
                                                    </div>";
				}


			if(!empty($error)){
				foreach($error as $msg){
					echo '<p>'.$msg.'</p>';
				}
			}



  		}

// Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();


  ?>

          </div>


        </form>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
