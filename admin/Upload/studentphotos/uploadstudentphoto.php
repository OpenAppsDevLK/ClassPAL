<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
?>


<html>
    	<head>
        		<title>Student Photo Uploader</title>
                        
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                
                <!-- Sweet Alert Class-->
                <script src="../../plugins/sweetalert/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="../../plugins/sweetalert/sweetalert.css">
                
    	</head>


<?php
include_once '../../php-includes/connect.inc.php';

	$name = ''; $type = ''; $size = ''; $error = '';
	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($source_url);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($source_url);

    		imagejpeg($image, $destination_url, $quality);
		return $destination_url;
	}

	if ($_POST) {

    		if ($_FILES["file"]["error"] > 0) {
        			$error = $_FILES["file"]["error"];
    		} 
    		else if (($_FILES["file"]["type"] == "image/gif") || 
			($_FILES["file"]["type"] == "image/jpeg") || 
			($_FILES["file"]["type"] == "image/png") || 
			($_FILES["file"]["type"] == "image/pjpeg")) {
				
				
                                 $Rmub = rand(100,10000);
                                $Student_ID = $_GET['StudentID'];
                                
        			$url = $Student_ID . '_' . $Rmub . '_photo.jpg';

        			$filename = compress_image($_FILES["file"]["tmp_name"], $url, 10);
        			//$buffer = file_get_contents($url);

        			/* Force download dialog... */
        			//header("Content-Type: application/force-download");
        			//header("Content-Type: application/octet-stream");
        			//header("Content-Type: application/download");

			/* Don't allow caching... */
        			//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        			/* Set data type, size and filename */
        			//header("Content-Type: application/octet-stream");
        			//header("Content-Transfer-Encoding: binary");
        			//header("Content-Length: " . strlen($buffer));
        		header("Content-Disposition: filename=$url");

        			/* Send our file... */
        			echo $buffer;
        			//echo $url;
                                
 global $db;
 
    //Used a prepared statment to update image name to the database..)
    $stmt = $db->prepare("UPDATE cp_students SET stu_image_name=? WHERE `stu_studentID`='$Student_ID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('s', $url);
    $stmt->execute();
    $stmt->close(); 
    
    
    
    
                                echo "<script> 
                                    
                                setTimeout(function() {
                                    swal({
                                        title: 'Success!!',
                                        text: 'Student Photo Uploaded!',
                                        type: 'success'
                                    }, function() {
                                        window.top.close();
                                       
                                    });
                                }, 1000);


                                    
                                    </script>";
        			
    		}else {
        			$error = "Uploaded image should be jpg or gif or png";
    		}
	}
?>

        <body style="background-color: #D2E4E8">

		<div class="message">
                    	
                	</div>
            
            
<script>
        
        function CloseWindow(){
            
            window.top.close();
            
        }
</script>

            <div class="container">
		<div class="row">
            	    	<legend style="margin-top: 10px;">Upload Image:</legend>    
                        <h6>Please upload photos less than 1MB</h6>
			<form action="" name="myform" id="myform" method="post" enctype="multipart/form-data">
				
			            	 <div class="form-group">
					
                                                <input type="text" name="Student_ID" class="form-control" value="<?php echo $_GET['StudentID']; ?>" readonly="readonly" />
                                         </div>
                            
                             <div class="form-group">
                                 <input type="file" name="file" class="form-control" id="file" required/>
					
                             </div>
                            
                             <div class="form-group">
                                 
                                 <input type="submit" name="submit" id="submit" value="Upload Now" class="form-control" class="submit btn-info"/>
				 <button class="btn  btn-danger" style="margin-top: 10px;" onclick="CloseWindow()" >Close Window</button>  	
                             </div>
			</form>
                </div>
            </div>
	</body>
</html>

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

?>