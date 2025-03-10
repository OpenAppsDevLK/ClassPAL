<?php
// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//linked with onlineregistrations.inc.php
include_once '../php-includes/connect.inc.php'; 

//Select multi recodes



     $rowCount = count($_POST["checkbox"]);

            for($i=0;$i<$rowCount;$i++) {


            //Delete Student
            $stmt = $db->prepare("DELETE FROM cp_online_reg_stu WHERE stu_studentID='" . $_POST["checkbox"][$i] . "'");
            $stmt->execute();
            $stmt->close();


            }


//Jump to the same page after.
header('Location: ../index.php?page=OnlineRegistrations');






// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}

// Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();

?>
