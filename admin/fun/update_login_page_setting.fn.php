<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];  
        
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);


//Call in settings.inc.php

include_once '../php-includes/connect.inc.php';  


function update_login_page_settings(){
 
    if(isset($_POST['btn_login_page_settisngs'])){
        
 
            global $db;
            
            
            
        if (!file_exists($_FILES['teacher_photo']['tmp_name']))
       {
           $imagename =  $_POST['uploaded_teacher_photo'];
           
       } else {
           
                     
          //Image compress and upload   
          $Rnumber = mt_rand(100000,1000000);
                                
          $imagename = $Rnumber.'_'.$_FILES['teacher_photo']['name'];
          $source = $_FILES['teacher_photo']['tmp_name'];
          $target = "Upload/teacherphoto/".$imagename;
          move_uploaded_file($source, $target);

          $imagepath = $imagename;
          $save = "Upload/teacherphoto/" . $imagepath; //This is the new file you saving
          $file = "Upload/teacherphoto/" . $imagepath; //This is the original file

          list($width, $height) = getimagesize($file); 

          $tn = imagecreatetruecolor($width, $height);

          //$image = imagecreatefromjpeg($file);
          $info = getimagesize($target);
          if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($file);
          }elseif ($info['mime'] == 'image/gif'){
            $image = imagecreatefromgif($file);
          }elseif ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($file);
          }

          imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
          imagejpeg($tn, $save, 60);

        
       }
       
       
   
    
    
    if (isset($_POST['txt_tea_name'])) {
        $var_txt_tea_name = mysqli_real_escape_string($db, $_POST['txt_tea_name']);
    }


    
       global $db;

       //Used a prepared statment to update annousments to the database..)
    $stmt = $db->prepare("UPDATE cp_settings SET teacher_name=?, teacher_photo=? WHERE `setting_id`=4" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('ss', $var_txt_tea_name, $imagename);
    $stmt->execute();
    $stmt->close(); 
    
    
    return($stmt);
    
    
      }
      
   }
    
  
    
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>