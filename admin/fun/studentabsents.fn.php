<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in AddAbsents.inc.php

include_once '../php-includes/connect.inc.php';   

function addabsents(){
    
if (isset($_POST['btn_ab'])){
    
    global $db;
    

 if (isset($_POST['txt_abID'])) {
        $varATTiD = mysqli_real_escape_string($db, $_POST['txt_abID']);
    }

    if (isset($_POST['txt_abdate'])) {
       $varAttdate =  mysqli_real_escape_string($db, $_POST['txt_abdate']);
    }
    
    
    if (isset($_POST['txt_ab_student_id'])) {
    $varStudentID = mysqli_real_escape_string($db, $_POST['txt_ab_student_id']);
    }
    
    if (isset($_POST['txt_ab_SubjectID'])) {
    $varSubjID = mysqli_real_escape_string($db, $_POST['txt_ab_SubjectID']);
    }
 


  global $db;

            $stmt5 = $db->prepare("SELECT stu_studentID FROM `cp_students` WHERE stu_studentID LIKE '%{$varStudentID}%'");
            $stmt5->bind_result($Student_id);
            $stmt5->execute(); 

             while ($stmt5->fetch()){

             }
             

if ($Student_id == $varStudentID){
    

        
                global $db;
    
                //Used a prepared statment to add attendenace to the database..)
             $stmt = $db->prepare("INSERT INTO `cp_absent` (id, date, student_id, subj_id) VALUES (?, ?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB                            [Time Zone]
             $stmt->bind_param('isii', $varATTiD, $varAttdate, $varStudentID, $varSubjID);
             $stmt->execute();
             $stmt->close(); 

              //This is inside a function, So we need to return the value to run this function...
             return($stmt);
    
         } else {
             
             echo "<script>sweetAlert('Oops... OMG', 'No student under this ID..!! Check and Try Again', 'error');</script>";
         }  
            

    
   }
 }
 
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

    
?>
