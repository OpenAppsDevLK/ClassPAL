<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];




//includes Files
include_once 'php-includes/connect.inc.php';
include_once 'php-includes/header.inc.php';
include_once 'php-includes/topnav.inc.php';
include_once 'php-includes/get-var.inc.php';
include_once 'php-includes/sidebarleft.inc.php';



// Function Files
include_once 'fun/addstudent.fn.php';
include_once 'fun/updatestudentdetils.fn.php';
include_once 'fun/addpayment.fn.php';
include_once 'fun/studentattendance.fn.php';
include_once 'fun/subjectallocation.fn.php';
include_once 'fun/updatesubject.fn.php';
include_once 'fun/adduser.fn.php';
include_once 'fun/updateuser.fn.php';
include_once 'fun/announcement.fn.php';
include_once 'fun/updateannouncement.fn.php';
include_once 'fun/addnotes.fn.php';
include_once 'fun/updatenotes.fn.php';
include_once 'fun/changebnumber.fn.php';
include_once 'fun/addins.fn.php';
include_once 'fun/updateins.fn.php';
include_once 'fun/addexammarks.fn.php';
include_once 'fun/addexam.fn.php';
include_once 'fun/updateexam.fn.php';
include_once 'fun/sendExsms.fn.php';
include_once 'fun/studentabsents.fn.php';
include_once 'fun/joinexammarks.fn.php';
include_once 'fun/update_sms_gway_setting.fn.php';
include_once 'fun/addsubject.fn.php';
include_once 'fun/update_enable_disable_setting.fn.php';
include_once 'fun/update_login_page_setting.fn.php';
include_once 'fun/addcertificate.fn.php';
include_once 'fun/user_quick_notes.fn.php';
include_once 'fun/update_barcode.fn.php';
include_once 'fun/add_ap_results.fn.php';
include_once 'fun/update_cer_obt.fn.php';
include_once 'fun/changebchnumber.fn.php';




if ($page == "AddStudents"){
     require_once 'php-includes/addstudents.inc.php';
}  else {
    if ($page == "ViewAllStudents"){
     require_once 'php-includes/viewallstudents.inc.php';
} else {
    if ($page == "StudentAttendance"){
     require_once 'php-includes/studentsttendance.inc.php';
} else {
     if ($page == "UpdateStudentDetails"){
     require_once 'php-includes/updatestudentdetails.inc.php';
} else {
     if ($page == "AddPayment"){
     require_once 'php-includes/addpayment.inc.php';
} else {
     if ($page == "PrintReceipt"){
     require_once 'php-includes/receipt.inc.php';
} else {
     if ($page == "ViewAllPayments"){
     require_once 'php-includes/viewallpayments.inc.php';
} else {
     if ($page == "ViewSubjectAllocatedStudents"){
     require_once 'php-includes/viewsubjallostudents.inc.php';
} else {
     if ($page == "CourseAllocation"){
     require_once 'php-includes/subjectallocation.inc.php';
} else {
     if ($page == "SubNPay"){
     require_once 'php-includes/SubNPay.inc.php';

} else {
     if ($page == "EditSubject"){
     require_once 'php-includes/editsubject.inc.php';
} else {
       if ($page == "Reports"){
     require_once 'php-includes/reportdash.inc.php';
} else {
       if ($page == "AddUser"){
     require_once 'php-includes/adduser.inc.php';
} else {
       if ($page == "ViewAllUsers"){
     require_once 'php-includes/viewallusers.inc.php';

} else {
       if ($page == "EditUser"){
     require_once 'php-includes/edituser.inc.php';
} else {
       if ($page == "AssignPermissions"){
     require_once 'php-includes/assignpermissions.inc.php';
} else {
       if ($page == "AddAnnouncement"){
     require_once 'php-includes/announcement.inc.php';
}else {
    if ($page == "BConverter"){
     require_once 'php-includes/bconverter.inc.php';
} else {
     if ($page == "OldStudents"){
     require_once 'php-includes/oldstudents.inc.php';
} else {
      if ($page == "Branches"){
     require_once 'php-includes/branches.inc.php';
} else {
      if ($page == "AddExam"){
     require_once 'php-includes/addexam.inc.php';
} else {
      if ($page == "SendExamSMS"){
     require_once 'php-includes/sendExsms.inc.php';
} else {
      if ($page == "AddAbsents"){
     require_once 'php-includes/AddAbsents.inc.php';
} else {
        if ($page == "JoinExamMarks"){
     require_once 'php-includes/joinexammarks.inc.php';
} else {
         if ($page == "ViewJoinExamMarks"){
     require_once 'php-includes/viewjoinexammarks.inc.php';
} else {
      if ($page == "Help"){
     require_once 'php-includes/help.inc.php';
} else {
 
             if ($page == "StudentPhoto"){
     require_once 'php-includes/studentphoto.inc.php';
} else {
              if ($page == "ViewAllAttendance"){
     require_once 'php-includes/viewallattendance.inc.php';
} else {
              if ($page == "Settings"){
     require_once 'php-includes/settings.inc.php';

} else {
               if ($page == "AddCertificate"){
     require_once 'php-includes/addcertificate.inc.php';   
} else {
               if ($page == "AddStudentPayments"){
     require_once 'php-includes/addstudentpayments.inc.php';
} else {
               if ($page == "ViewAllAllowStudents"){
     require_once 'php-includes/viewallallowstudents.inc.php';  
} else {
               if ($page == "OnlineRegistrations"){
     require_once 'php-includes/onlineregistrations.inc.php';
} else {
               if ($page == "ViewExercises"){
     require_once 'php-includes/view_exercises.inc.php';    
} else {
               if ($page == "CConverter"){
     require_once 'php-includes/cconverter.inc.php';
}     
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}










// If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}


?>





<?php

include_once 'php-includes/footer.inc.php';

?>
