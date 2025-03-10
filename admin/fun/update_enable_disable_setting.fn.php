<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];  
        
        
//Call in Settings.inc.php

include_once '../php-includes/connect.inc.php';   


function Update_enable_disable_settings(){
 
    if(isset($_POST['btn_e_d_reg'])){
        
 
            global $db;


    if (isset($_POST['ck_e_d_reg'])) {
        $var_ck_en_de_reg = mysqli_real_escape_string($db, $_POST['ck_e_d_reg']);
    }


    
       global $db;

       //Used a prepared statment to update annousments to the database..)
    $stmt = $db->prepare("UPDATE cp_settings SET Enable_Disable_Stu_Reg=? WHERE `setting_id`=3" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('i', $var_ck_en_de_reg);
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