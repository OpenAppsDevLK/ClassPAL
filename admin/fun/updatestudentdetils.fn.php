<?php


 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in updatestudentdetails.inc.php

include_once '../php-includes/connect.inc.php';  


function upadtestudent(){
  
       global $db;
             
       
 if (isset($_POST['txt_AutoID'])) {
        $var_US_ID = mysqli_real_escape_string($db, $_POST['txt_AutoID']);
    }

    if (isset($_POST['txt_student_id'])) {
        $var_US_StudentID =  mysqli_real_escape_string($db, $_POST['txt_student_id']);
    }
    
    
    if (isset($_POST['txt_regDate'])) {
    $var_US_StuRegDate = mysqli_real_escape_string($db, $_POST['txt_regDate']);
    }
    
    if (isset($_POST['txt_student_name'])) {
    $var_US_StuName = mysqli_real_escape_string($db, $_POST['txt_student_name']);
    }
    
    if (isset($_POST['txt_student_address'])) {
    $var_US_StuAddress = mysqli_real_escape_string($db, $_POST['txt_student_address']);
    }
    
    if (isset($_POST['txt_student_sex'])) {
    $var_US_StuSex = mysqli_real_escape_string($db, $_POST['txt_student_sex']);
    }

    
    $var_US_StuBday = $_POST['txt_BDate'];
        
    if (!empty($var_US_StuBday)) {
        $var_US_StuBday = mysqli_real_escape_string($db, $_POST['txt_BDate']);
        
      } else {
        $var_US_StuBday = "0000-00-00";
      }     
    
    
    if (isset($_POST['txt_student_hmphone'])) {
    $var_US_HomePhone = mysqli_real_escape_string($db, $_POST['txt_student_hmphone']);
    }
    
   
    if (isset($_POST['txt_student_Mno01'])) {
    $var_US_MobNo01 = mysqli_real_escape_string($db, $_POST['txt_student_Mno01']);

    }
    
    if (isset($_POST['txt_student_Mnub02'])) {
    $var_US_MobNo02 = mysqli_real_escape_string($db, $_POST['txt_student_Mnub02']);

    }
    
    if (isset($_POST['txt_student_email'])) {
    $var_US_StuEmail = mysqli_real_escape_string($db, $_POST['txt_student_email']);

    }
   
    
    if (isset($_POST['txt_student_notes'])) {
    $var_US_StuNotes = mysqli_real_escape_string($db, $_POST['txt_student_notes']);

    }
    
    
      if (isset($_POST['txt_student_nic'])) {
    $varStuNIC = mysqli_real_escape_string($db, $_POST['txt_student_nic']);

    }
    
    if (isset($_POST['txt_student_school'])) {
    $varStuSchool = mysqli_real_escape_string($db, $_POST['txt_student_school']);

    }
 
    if (isset($_POST['txt_student_accesskey'])) {
    $varStuAccessKey = mysqli_real_escape_string($db, $_POST['txt_student_accesskey']);

    }

    
       global $db;
    

    
       //Used a prepared statment to update student to the database..)
    $stmt = $db->prepare("UPDATE cp_students SET stu_ID=?, stu_studentID=?, stu_regdate=?, stu_studentname=?, stu_address=?, stu_sex=?, stu_bday=?, stu_con_home=?, stu_con_mobile1=?, stu_con_mobile2=?, stu_email=?, stu_notes=?, stu_nic=?, stu_school=?, stu_accesskey=? WHERE `stu_studentID`='$var_US_StudentID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('iissssssssssssi', $var_US_ID, $var_US_StudentID, $var_US_StuRegDate, $var_US_StuName, $var_US_StuAddress, $var_US_StuSex, $var_US_StuBday, $var_US_HomePhone, $var_US_MobNo01, $var_US_MobNo02, $var_US_StuEmail, $var_US_StuNotes, $varStuNIC, $varStuSchool, $varStuAccessKey);
    $stmt->execute();
    $stmt->close(); 
  
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>