<?php
// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//linked with announcement.inc.php

//include
include_once '../php-includes/connect.inc.php'; 

if (isset($_GET['AnnouncementID'])) {    // GET instead of POST for value in the URL
   $VarAnnouncementID = $_GET['AnnouncementID']; // only id is needed - delete other variable assignments

   }


        $stmt = $db->prepare("DELETE FROM `cp_announcements` WHERE `id` = ?");
        $stmt->bind_param('i', $VarAnnouncementID);
        $stmt->execute();
        $stmt->close();




       //Jump to the same page after.
        header('Location: ../index.php?page=AddAnnouncement');



 // If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}

 // Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();
    ?>
