<?php


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in addstudents.inc.php

include_once '../php-includes/connect.inc.php'; 

function addstudent(){

if(isset($_POST['txt_student_name'])){
    
    global $db;
 
    
 if (isset($_POST['txt_AutoID'])) {
        $var_AS_ID = mysqli_real_escape_string($db, $_POST['txt_AutoID']);     
 }

           

    if (isset($_POST['txt_student_id'])) {
        $var_AS_StudentID =  mysqli_real_escape_string($db, $_POST['txt_student_id']);
    }
    
    if (isset($_POST['txt_regDate'])) {
    $var_AS_StuRegDate = mysqli_real_escape_string($db, $_POST['txt_regDate']);
    }
    
    if (isset($_POST['txt_student_name'])) {
    $var_AS_StuName = mysqli_real_escape_string($db, $_POST['txt_student_name']);
    }
    
    if (isset($_POST['txt_student_address'])) {
    $var_AS_StuAddress = mysqli_real_escape_string($db, $_POST['txt_student_address']);
    }
    
    if (isset($_POST['txt_student_sex'])) {
    $var_AS_StuSex = mysqli_real_escape_string($db, $_POST['txt_student_sex']);
    }
    
    
    $var_AS_StuBday = $_POST['txt_BDate'];
        
    if (!empty($var_AS_StuBday)) {
        $var_AS_StuBday = mysqli_real_escape_string($db, $_POST['txt_BDate']);
        
      } else {
        $var_AS_StuBday = "0000-00-00";
      } 
      
      
      
    
    if (isset($_POST['txt_student_hmphone'])) {
    $var_AS_HomePhone = mysqli_real_escape_string($db, $_POST['txt_student_hmphone']);
    }
    
   
    if (isset($_POST['txt_student_Mno01'])) {
    $var_AS_MobNo01 = mysqli_real_escape_string($db, $_POST['txt_student_Mno01']);

    }
    
    if (isset($_POST['txt_student_Mnub02'])) {
    $var_AS_MobNo02 = mysqli_real_escape_string($db, $_POST['txt_student_Mnub02']);

    }
    
    if (isset($_POST['txt_student_email'])) {
    $var_AS_StuEmail = mysqli_real_escape_string($db, $_POST['txt_student_email']);

    }
   
    
    if (isset($_POST['txt_student_notes'])) {
    $var_AS_StuNotes = mysqli_real_escape_string($db, $_POST['txt_student_notes']);

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
         
         
        if (!file_exists($_FILES['txt_student_Photo']['tmp_name']))
       {
           $imagename =  $_POST['hid_student_Photo'];
               

           
       } else {
           
                     
          //Image compress and upload   
          $Student_ID = $var_AS_StudentID;
                                
          $imagename = $Student_ID.'_'.$_FILES['txt_student_Photo']['name'];
          $source = $_FILES['txt_student_Photo']['tmp_name'];
          $target = "Upload/studentphotos/".$imagename;
          move_uploaded_file($source, $target);

          $imagepath = $imagename;
          $save = "Upload/studentphotos/" . $imagepath; //This is the new file you saving
          $file = "Upload/studentphotos/" . $imagepath; //This is the original file

          list($width, $height) = getimagesize($file); 

          $tn = imagecreatetruecolor($width, $height);

          //$image = imagecreatefromjpeg($file);
          $info = getimagesize($target);
          if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($file);
          }elseif ($info['mime'] == 'image/gif'){
            $image = imagecreatefromgif($file);
          }elseif ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($file);
          }

          imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height);
          imagejpeg($tn, $save, 15);

        
       }


   //-------------Subject Allocation------------------
    
    if (isset($_POST['txt_AlloAutoID'])) {
        $var_AS_AlloID = mysqli_real_escape_string($db, $_POST['txt_AlloAutoID']);
    }

    
    if (isset($_POST['txt_subject'])) {
    $var_AS_SubjID = mysqli_real_escape_string($db, $_POST['txt_subject']);
    }
    if (isset($_POST['txt_Institue_id'])) {
    $var_AS_Instituteid = mysqli_real_escape_string($db, $_POST['txt_Institue_id']);
    }
    
    if (isset($_POST['txt_subject_fee'])) {
    $var_AS_subj_fee = mysqli_real_escape_string($db, $_POST['txt_subject_fee']);
    }
    
    
    if (isset($_POST['txt_batch_no'])) {
    $var_AS_BchNo = mysqli_real_escape_string($db, $_POST['txt_batch_no']);
    }
    
    if (isset($_POST['txt_allocation_notes'])) {
    $var_AS_AlloNotes = mysqli_real_escape_string($db, $_POST['txt_allocation_notes']);
    
    
    if (isset($_POST['txt_student_barcode'])) {
    $var_txt_student_barcode= mysqli_real_escape_string($db, $_POST['txt_student_barcode']);
    } 
    
//    echo "<script> window.location = 'index.php?page=StudentPhoto&StudentID=$var_AS_StudentID'";  
//    echo "</script>";
    }
    
    //$UploadName = "df.jpg";
    
       global $db;
    
       //Used a prepared statment to add course allocation to the database..)
    $stmt1 = $db->prepare("INSERT INTO `cp_subj_allo` (sa_id, sa_stu_student_id, sa_stu_student_Name, sa_subj_id, sa_institutid,  sa_subj_fee, sa_batch_no, sa_notes, sa_barCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt1->bind_param('iisiidssi', $var_AS_AlloID, $var_AS_StudentID, $var_AS_StuName, $var_AS_SubjID, $var_AS_Instituteid, $var_AS_subj_fee, $var_AS_BchNo, $var_AS_AlloNotes, $var_txt_student_barcode);
    $stmt1->execute();
    $stmt1->close(); 
    

    
       //Used a prepared statment to add student to the database..)
    $stmt2 = $db->prepare("INSERT INTO `cp_students` (stu_ID, stu_studentID, stu_regdate, stu_studentname, stu_address, stu_sex, stu_bday, stu_con_home, stu_con_mobile1, stu_con_mobile2, stu_email, stu_notes, stu_image_name, stu_nic, stu_school, stu_accesskey) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt2->bind_param('iisssssssssssssi', $var_AS_ID, $var_AS_StudentID, $var_AS_StuRegDate, $var_AS_StuName, $var_AS_StuAddress, $var_AS_StuSex, $var_AS_StuBday, $var_AS_HomePhone, $var_AS_MobNo01, $var_AS_MobNo02, $var_AS_StuEmail, $var_AS_StuNotes, $imagename, $varStuNIC, $varStuSchool, $varStuAccessKey);
    $stmt2->execute();
    $stmt2->close(); 
    

    
       //Redirect to the page after inset 
   echo "<script>location='index.php?page=AddStudents'</script>";
   

    
   }
    
  }  
    
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
?>