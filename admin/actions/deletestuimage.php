<?php
// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//Call on updatestudent.inc.php


//include
include_once '../php-includes/connect.inc.php'; 

//Set the pageNo and book_id comming from URL to variable
  $PNo = $_GET["PageNo"];
  $varStudentID = $_GET['StudentID'];




//Set imagename comming from URL to $UploadName
    if (isset($_GET['txt-uploadename'])) {
        $UploadName = $_GET['txt-uploadename'];



        global $UploadName;
        global $db;

if ($UploadName == 'df.jpg'){
    header('Location: ../index.php?StudentID='. $varStudentID .'&page=UpdateStudentDetails&PageNo=' . $PNo);
    die("File Not Deleted");
}

//Unlink command will delete files. Get the image name from Upload directory
$flgDelete = unlink("../Upload/studentphotos/$UploadName");
if($flgDelete)
{
    //$dbImageName will equal to "df.jpe"(defult image if there is no image) and that name will update in the database.
    $dbImageName = "df.jpg";
    $stmt = $db->prepare("UPDATE cp_students SET stu_image_name=?  WHERE `stu_studentID`='$varStudentID' ");
    $stmt->bind_param('s', $dbImageName);
    $stmt->execute();
    $stmt->close();

        //Jump to the same page after
        header('Location: ../index.php?StudentID='. $varStudentID .'&page=UpdateStudentDetails&PageNo=' . $PNo);
}
else
{
        //Jump to the same page if not...
	header('Location: ../index.php?StudentID='. $varStudentID .'&page=UpdateStudentDetails&PageNo=' . $PNo);
}

}


     // If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}


// Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();

?>
