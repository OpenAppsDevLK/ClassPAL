<?php

// Browser Session Start here
session_start(); 
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in studentattendance.inc.php

include_once '../php-includes/connect.inc.php';  

function addattendance(){
    
        global $db;
        
    
if (isset($_POST['btn_Attendance_01']) OR ($_POST['btn_Attendance'])){
    


    if (isset($_POST['txt_attendate'])) {
       $varAttdate =  mysqli_real_escape_string($db, $_POST['txt_attendate']);
    }
    
    
    if (isset($_POST['txt_sa_student_barcode'])) {
    $varStudentBarCode = mysqli_real_escape_string($db, $_POST['txt_sa_student_barcode']);
    }
    
 
//TimeZone Configerations...
$date = new DateTime('',new DateTimeZone('Asia/Colombo'));
$date->setTimezone(new DateTimeZone('Asia/Colombo'));


  global $db;

            $stmt5 = $db->prepare("SELECT sa_stu_student_id, sa_subj_id, sa_barCode FROM `cp_subj_allo` WHERE sa_barCode LIKE '%{$varStudentBarCode}%'");
            $stmt5->bind_result($Student_id, $sa_subj_id, $stu_barcode);
            $stmt5->execute(); 

             while ($stmt5->fetch()){

             }
             

if ($stu_barcode == $varStudentBarCode){
    

        
                global $db;
    
                //Used a prepared statment to add attendenace to the database..)
             $stmt = $db->prepare("INSERT INTO `cp_attendance` (date, student_id, subj_id, att_time) VALUES (?, ?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB                            [Time Zone]
             $stmt->bind_param('siis', $varAttdate, $Student_id, $sa_subj_id, $date->format('H:i:s'));
             $stmt->execute();
             $stmt->close(); 

    
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
