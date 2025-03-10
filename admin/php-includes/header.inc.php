<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ClassPAL | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    
     <link rel="stylesheet" href="css/styles.css">
     
  <!-- Jquery Fullcalandar Class-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  

  

  
  
<!-- Sweet Alert Class-->
<script src="plugins/sweetalert/sweetalert-dev.js"></script>
<link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">


<!-- Jq Calx plugin, this is for calulate from input values, call in additem.inc.php (name="txt-br-bundle-price") (data-cell) (data-format)-->
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="plugins/calx/jquery-calx-2.2.3.min.js"></script>

<script type="text/javascript" src="php-includes/typeahead.js"></script>


    <!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">


<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
   
<!-- Go back of a URL -->
<script>
function goBack() {
    window.history.back();
}
</script>

     <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>  
    

<!-- This is for html 5 date from for firefox and other web browsers -->
<!-- cdn for modernizr, if you haven't included it already -->
<script src="https://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="https://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script> 

    
<?php
        
global $db;
        
            //Layout Boxed
            $stmt_sidebar_setting = $db->prepare("SELECT value FROM `cp_sidebar` WHERE `id`=1");
            $stmt_sidebar_setting->bind_result($Setting_01);
            $stmt_sidebar_setting->execute(); 

             while ($stmt_sidebar_setting->fetch()){

             }
             

?>

      
 <?php
        
global $db;

            //sidebar-collapse
            $stmt_sidebar_setting2 = $db->prepare("SELECT value FROM `cp_sidebar` WHERE `id`=2");
            $stmt_sidebar_setting2->bind_result($Setting_02);
            $stmt_sidebar_setting2->execute(); 

             while ($stmt_sidebar_setting2->fetch()){

             }
             

?>

    
  </head>
  <body class="hold-transition skin-blue sidebar-mini <?php echo $Setting_01; ?> <?php echo $Setting_02; ?>" >
    <div class="wrapper">

      <header class="main-header">

<!-- Logo -->
<a href="dash.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>CP</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Class</b>PAL</span>
</a>

<?php

    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
     
?>        