<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

include_once '../php-includes/connect.inc.php'; 

     if (isset($_GET["SMSKey"])){
          $SMSKey = $_GET["SMSKey"];

          //Limit the SMS
          $From = $_GET["FROM"];
          $To = $_GET["TO"];
          //$ExCode = $_GET["ExamCode"];




                $sql = "SELECT cp_exams.id, cp_exams.ex_studentid, cp_exams.ex_studentname, cp_exams.ex_subjid, cp_exams.ex_batchno, cp_exams.ex_examdate, cp_exams.ex_code, cp_exams.ex_marks, cp_exams.ex_grade, cp_exams.act_w_rank, cp_exams_list.ex_code, cp_exams_list.ex_des, cp_students.stu_con_mobile1  FROM `cp_exams` INNER JOIN `cp_students` ON cp_students.stu_studentID = cp_exams.ex_studentid LEFT JOIN `cp_exams_list` ON cp_exams_list.ex_code = cp_exams.ex_code WHERE cp_exams.ex_code LIKE '%{$SMSKey}' ORDER BY cp_exams.ex_marks DESC LIMIT $From,$To";
                $query = mysqli_query($db, $sql);


                //$rank = $previous = 0;




while($row = mysqli_fetch_array($query, MYSQLI_ASSOC))
{
    // break statement at the end has no effect since you are doing echo on top.
    //if ($rank == 10000)break;

    // If same total will skip $rank++
    //if($row['ex_marks'] != $previous)$rank++;



    // Current row student's total
    //$previous = $row['ex_marks'];

  //echo "<tr><td>".$row['ex_studentid']."</td><td>$rank</td><td>".$row['ex_marks']."</td></tr>";

    //This will select SMS gateway code and token form db...
    $stmt_select_sms_gway_settings = $db->prepare("SELECT sms_gway_dcode, sms_gway_token, sms_gway_name FROM `cp_settings` WHERE `setting_id`=2 ");
    $stmt_select_sms_gway_settings->bind_result($sms_gway_dcode, $sms_gway_token, $sms_gway_name);
    $stmt_select_sms_gway_settings->execute();

        while ($stmt_select_sms_gway_settings->fetch()){

                     //if the gateway SemySMS this code executed
            if ($sms_gway_name === "SemySMS"){

                                    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
                                    $phone = $row['stu_con_mobile1']; // Phone number
                                    $msg = "StudentName:{$row['ex_studentname']} ExamDate:{$row['ex_examdate']} ExamName:{$row['ex_des']} ExamMarks: {$row['ex_marks']} WholeRank: {$row['act_w_rank']} Grade: {$row['ex_grade']}"; // Message
                                    $device = $sms_gway_dcode;  //  Device code
                                    $token = $sms_gway_token;  //  Your token (secret)

                                    $data = array(
                                           "phone" => $phone,
                                           "msg" => $msg,
                                           "device" => $device,
                                           "token" => $token
                                       );

                                       $curl = curl_init($url);
                                       curl_setopt($curl, CURLOPT_POST, true);
                                       curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                       curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                                       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                                       curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                                       $output = curl_exec($curl);
                                       curl_close($curl);

                                       echo $output;


            } else {

                //If NOT, Textit Gateway will send the message.
                $user = $sms_gway_dcode;
                $password = $sms_gway_token;
                $text = urlencode("StudentName:{$row['ex_studentname']} ExamDate:{$row['ex_examdate']} ExamName:{$row['ex_des']} ExamMarks: {$row['ex_marks']} WholeRank: {$row['act_w_rank']} Grade: {$row['ex_grade']}");
                $to = $row['stu_con_mobile1'];

                $baseurl ="http://www.textit.biz/sendmsg";
                $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
                $ret = file($url);

                $res= explode(":",$ret[0]);

                if (trim($res[0])=="OK")
                {
                echo "Message Sent - ID : ".$res[1];
                }
                else
                {
                echo "Sent Failed - Error : ".$res[1];
                }

            }


        }



   continue;
}



}

// If session isn't meet, user will redirect to login page
} else {
    header('Location: ../login.php');
}

?>
