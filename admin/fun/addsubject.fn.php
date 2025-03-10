<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
//Call in SubNPay.inc.php

include_once '../php-includes/connect.inc.php';   


function addsubject(){
    
        global $db;
        
 
    if(isset($_POST['btn_submit_addSubject'])){
        
 
   //-------------ADD exam------------------
    
    if (isset($_POST['txt_subj_id'])) {
        $var_SubjAutoID = mysqli_real_escape_string($db, $_POST['txt_subj_id']);
    }
    
    if (isset($_POST['txt_subj_name'])) {
        $var_Subj_Name = mysqli_real_escape_string($db, $_POST['txt_subj_name']);
    }
    
    if (isset($_POST['txt_subj_des'])) {
        $var_subj_des = mysqli_real_escape_string($db, $_POST['txt_subj_des']);
    }    
    
    
    if (isset($_POST['txt_subj_fee'])) {
        $var_Subj_Fee = mysqli_real_escape_string($db, $_POST['txt_subj_fee']);
    }
    
       global $db;

       //Used a prepared statment to add annousments to the database..)
    $stmt = $db->prepare("INSERT INTO `cp_subjects` (subj_id, subj_name, subj_classfee, subj_des) VALUES (?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('isds', $var_SubjAutoID, $var_Subj_Name, $var_Subj_Fee, $var_subj_des);
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