<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in adduser.inc.php

include_once '../php-includes/connect.inc.php';   


function adduser(){
    

 
    if(isset($_POST['btn_submit'])){
        
        global $db;
        
          
   //-------------Add User------------------
    
    if (isset($_POST['txt_AU_AutoID'])) {
        $var_AU_AutoID = mysqli_real_escape_string($db, $_POST['txt_AU_AutoID']);
    }

    if (isset($_POST['txt_AU_username'])) {
        $var_AU_username = mysqli_real_escape_string($db, $_POST['txt_AU_username']);
    }
    
    if (isset($_POST['txt_AU_pass'])) {
        $var_AU_Pass = sha1(mysqli_real_escape_string($db, $_POST['txt_AU_pass']));
    }
    
    if (isset($_POST['txt_AU_Fname'])) {
    $var_AU_Fname = mysqli_real_escape_string($db, $_POST['txt_AU_Fname']);
    }
    
    if (isset($_POST['txt_AU_LName'])) {
    $var_AU_Lname = mysqli_real_escape_string($db, $_POST['txt_AU_LName']);
    }
    
  
    
       global $db;
   
    //Used a prepared statment to add user permissions to the database..)
    $stmt2 = $db->prepare("INSERT INTO `cp_userpermission` (permission_id, uid, OnOff) VALUES (1111, '$var_AU_AutoID', 0), (1112, '$var_AU_AutoID', 1), (1113, '$var_AU_AutoID', 1), (1114, '$var_AU_AutoID', 0), (1115, '$var_AU_AutoID', 0), (1116, '$var_AU_AutoID', 1),(1117, '$var_AU_AutoID', 1),(1118, '$var_AU_AutoID', 1),(1119, '$var_AU_AutoID', 0),(1120, '$var_AU_AutoID', 0),(1121, '$var_AU_AutoID', 0),(1122, '$var_AU_AutoID', 0),(1123, '$var_AU_AutoID', 0),(1124, '$var_AU_AutoID', 1),(1125, '$var_AU_AutoID', 0),(1126, '$var_AU_AutoID', 0),(1127, '$var_AU_AutoID', 0), (1128, '$var_AU_AutoID', 0), (1129, '$var_AU_AutoID', 0), (1130, '$var_AU_AutoID', 0), (1131, '$var_AU_AutoID', 0), (1132, '$var_AU_AutoID', 0), (1133, '$var_AU_AutoID', 0), (1134, '$var_AU_AutoID', 0), (1135, '$var_AU_AutoID', 0), (1136, '$var_AU_AutoID', 0)");
    //i - integer / d - double / s - string / b - BLOB
    //$stmt2->bind_param('iii', $var_AU_AutoID, $var_AU_AutoID, $var_AU_AutoID);
    $stmt2->execute();
    $stmt2->close(); 
    
    
       //Used a prepared statment to add user to the database..)
    $stmt1 = $db->prepare("INSERT INTO `cp_users` (id, username, password, firstname, lastname) VALUES (?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt1->bind_param('issss', $var_AU_AutoID, $var_AU_username, $var_AU_Pass, $var_AU_Fname, $var_AU_Lname);
    $stmt1->execute();
    $stmt1->close(); 
        
    $stmt3 = $stmt2 ;
    $stmt3 = $stmt1;
   
    return($stmt1);
    
    
      }
     
   }
    
  
  
        // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
    
?>