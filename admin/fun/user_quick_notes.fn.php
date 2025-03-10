<?php


//ini_set('display_errors', '1'); 

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
include_once '../php-includes/connect.inc.php';   

//Call in dash.php

function updateQuicknotes(){
    
          global $db;

if (isset($_POST['btn_AddNote_submit'])){
    
     $quick_user_notes = $_SESSION['user_id'];
    
     $var_user_notes = $_POST['txt_user_notes'];
     
     

    
    //Used a prepared statment to update user quick note to the database..
    $stmt = $db->prepare("UPDATE cp_users SET user_notes=? WHERE `id`='$quick_user_notes'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('s', $var_user_notes);
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