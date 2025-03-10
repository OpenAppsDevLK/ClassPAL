<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
//Call in addpayments.inc.php

include_once '../php-includes/connect.inc.php';  

function addpayment(){
    
        global $db;
        
    


 if (isset($_POST['txt_RecpID'])) {
        $varPayID = mysqli_real_escape_string($db, $_POST['txt_RecpID']);
    }

    if (isset($_POST['txt_student_id'])) {
       $varPayStuID =  mysqli_real_escape_string($db, $_POST['txt_student_id']);
    }
    
    
    if (isset($_POST['txt_student_name'])) {
    $varPayStuName = mysqli_real_escape_string($db, $_POST['txt_student_name']);
    }
    
    
    if (isset($_POST['txt_subject_id'])) {
    $varPaySubjID = mysqli_real_escape_string($db, $_POST['txt_subject_id']);
    }
 
    if (isset($_POST['txt_Institue_name'])) {
    $varPayInsName = mysqli_real_escape_string($db, $_POST['txt_Institue_name']);
    }
    
    
    if (isset($_POST['txt_payDate'])) {
    $varPayDate = mysqli_real_escape_string($db, $_POST['txt_payDate']);
    }
    
    
    if (isset($_POST['txt_student_paymonth'])) {
    $varPayMonth = mysqli_real_escape_string($db, $_POST['txt_student_paymonth']);
    }
    
     if (isset($_POST['txt_student_subjfee'])) {
    $varPayCosFee = mysqli_real_escape_string($db, $_POST['txt_student_subjfee']);
    }
 
    if (isset($_POST['txt_student_admission'])) {
    $varPayCosAdmi = mysqli_real_escape_string($db, $_POST['txt_student_admission']);
    }
  
    if (isset($_POST['txt_student_total'])) {
    $varPayCosTotal = mysqli_real_escape_string($db, $_POST['txt_student_total']);
    }
    
    if (isset($_POST['txt_batch_nub'])) {
    $vartxt_batch_nub = mysqli_real_escape_string($db, $_POST['txt_batch_nub']);
    }
    
//Add Misc Payments
    
  
    if (isset($_POST['txt_mics_description'])) {
    $varMics_description = mysqli_real_escape_string($db, $_POST['txt_mics_description']);
    }
    
    
      
    if (isset($_POST['txt_mics_amount'])) {
    $varMics_Amount = mysqli_real_escape_string($db, $_POST['txt_mics_amount']);
    }
    
    
                global $db;
    
                //Used a prepared statment to add payments to the database..)
             $stmt = $db->prepare("INSERT INTO `cp_payments` (pay_id, Pay_stu_studentID, pay_student_name, pay_subj_id, pay_insName, pay_paymentdate, pay_paymentmonth, pay_cos_fee, pay_cos_admi, pay_cos_total, pay_misc_pay_description, pay_misc_amount, pay_stu_batch_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
             //i - integer / d - double / s - string / b - BLOB
             $stmt->bind_param('iisissidddsds', $varPayID, $varPayStuID, $varPayStuName, $varPaySubjID, $varPayInsName, $varPayDate, $varPayMonth, $varPayCosFee, $varPayCosAdmi, $varPayCosTotal, $varMics_description, $varMics_Amount, $vartxt_batch_nub);
             $stmt->execute();
             $stmt->close(); 

              // This is inside a function, So we need to return the value to run this function...
             return($stmt);
    
    
   }
    
        // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
?>
