<?php
$host = "localhost";
$db_user = "root";   
$db_pass = "";   
$db_name = "mydatabase";


$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// DO NOT close the connection here! Let signup.php close it when it is finished.
?>