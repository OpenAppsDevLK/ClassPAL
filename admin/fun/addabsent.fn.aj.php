<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in footer.inc.php
ob_start();

include_once '../php-includes/connect.inc.php';


   
   //-------------Mark Attendance------------------
    
     if (isset($_GET['StudentID'])) {
        $var_txt_StudentID = $_GET['StudentID'];
         
    }       
        
      if (isset($_GET['SubjectID'])) {
        $var_txt_SubjectID = $_GET['SubjectID'];
         
    }   
    
    
        $var_txt_Date = date('Y-m-d');
         



    
    
                global $db;
    
                //Used a prepared statment to add attendenace to the database..)
             $stmt = $db->prepare("INSERT INTO `cp_absent` (date, student_id, subj_id) VALUES (?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB                            [Time Zone]
             $stmt->bind_param('sii', $var_txt_Date, $var_txt_StudentID, $var_txt_SubjectID);
             $stmt->execute();
             $stmt->close(); 

              //This is inside a function, So we need to return the value to run this function...
             return($stmt);
             
             
  
  

} else { 
    header('Location: ../login.php');
}


    
    
    
?>