<?php


// Database Connection
$dbconnect = array(
    'server' => 'localhost',
    'dbuser' => 'xxxxxx', // Use same db username for other db.
    'dbpass' => 'xxxxxx',
    'dbname' => 'xxxxxx'   
);



$db = new mysqli (
        $dbconnect ['server'],
        $dbconnect ['dbuser'],
        $dbconnect ['dbpass'],
        $dbconnect ['dbname']

        );

if ($db->connect_errno>0){
    echo "Database Connect Error";
    exit;
}  else {
    //echo "Success";

}


?>

