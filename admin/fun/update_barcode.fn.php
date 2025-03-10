<?php


 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in viewsubjallostudents.inc.php

include_once '../php-includes/connect.inc.php';  


function upade_barcode(){
    

 
       global $db;
             
        

 if (isset($_POST['btn_submit_update_barcode'])) {
       
     
     
    if (isset($_POST['txt_bar_sa_id'])) {
        $var_Sa_id = mysqli_real_escape_string($db, $_POST['txt_bar_sa_id']);
    }

    if (isset($_POST['txt_bar_new_barcode'])) {
        $var_US_Stuent_barcode = mysqli_real_escape_string($db, $_POST['txt_bar_new_barcode']);
    }     
     
     
   
    }

    
    
       global $db;
    

    
       //Used a prepared statment to update student to the database..)
    $stmt = $db->prepare("UPDATE cp_subj_allo SET sa_barCode=? WHERE `sa_id`='$var_Sa_id'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('i', $var_US_Stuent_barcode);
    $stmt->execute();
    $stmt->close(); 
    

   
    
    
    return($stmt);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>