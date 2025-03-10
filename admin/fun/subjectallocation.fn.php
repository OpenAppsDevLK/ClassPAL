<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in subjectallcation.inc.php

include_once '../php-includes/connect.inc.php';  

function subjectallocation(){
    
        global $db;
        
    
   //-------------Subject Allocation------------------
    
    if (isset($_POST['txt_AlloAutoID'])) {
        $var_AS_AlloID = mysqli_real_escape_string($db, $_POST['txt_AlloAutoID']);
    }

    if (isset($_POST['txt_stu_id'])) {
        $var_AS_StuID = mysqli_real_escape_string($db, $_POST['txt_stu_id']);
    }
    
    if (isset($_POST['txt_stu_name'])) {
        $var_AS_StuName = mysqli_real_escape_string($db, $_POST['txt_stu_name']);
    }
    
    if (isset($_POST['txt_subject'])) {
    $var_AS_SubjID = mysqli_real_escape_string($db, $_POST['txt_subject']);
    }
       
    
    
    if (isset($_POST['txt_batch_no'])) {
    $var_AS_BchNo = mysqli_real_escape_string($db, $_POST['txt_batch_no']);
    }
    
    
    
    if (isset($_POST['txt_subject_fee'])) {
    $var_subject_fee = mysqli_real_escape_string($db, $_POST['txt_subject_fee']);
    }    


    if (isset($_POST['txt_allocation_notes'])) {
    $var_allocation_notes = mysqli_real_escape_string($db, $_POST['txt_allocation_notes']);
    }

    if (isset($_POST['txt_Institue_id'])) {
    $var_txt_Institue_id = mysqli_real_escape_string($db, $_POST['txt_Institue_id']);
    }
    
    if (isset($_POST['txt_student_barcode'])) {
    $var_txt_student_barcode= mysqli_real_escape_string($db, $_POST['txt_student_barcode']);
    }    
    

    
       global $db;
    
       //Used a prepared statment to add course allocation to the database..)
    $stmt1 = $db->prepare("INSERT INTO `cp_subj_allo` (sa_id, sa_stu_student_id, sa_stu_student_Name, sa_subj_id, sa_institutid, sa_subj_fee, sa_batch_no, sa_notes, sa_barCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt1->bind_param('iisiidssi', $var_AS_AlloID, $var_AS_StuID, $var_AS_StuName, $var_AS_SubjID, $var_txt_Institue_id, $var_subject_fee, $var_AS_BchNo, $var_allocation_notes, $var_txt_student_barcode);
    $stmt1->execute();
    $stmt1->close(); 
    
    
    
    return($stmt1);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>