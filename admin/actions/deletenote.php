<?php

// Some servers, header syntax not working,..Use this code if php header not working...
ob_start();

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//linked with notes.inc.php

//include
include_once '../php-includes/connect.inc.php';  

if (isset($_GET['NoteID'])) {    // GET instead of POST for value in the URL
   $VarN_NoteID = $_GET['NoteID']; // only id is needed - delete other variable assignments

   }


        $stmt = $db->prepare("DELETE FROM `cp_notes` WHERE `id` = ?");
        $stmt->bind_param('i', $VarN_NoteID);
        $stmt->execute();
        $stmt->close();




       //Jump to the same page after deleteing the image
        header('Location: ../index.php?page=Notes');


  // If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}

 // Some servers header syntax not working,..Use this code if php header not working...
ob_end_flush();

    ?>
