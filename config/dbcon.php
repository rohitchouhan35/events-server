<?php 

$host = "35.244.53.32";
$username = "testUser";
$password = "Pr|z|/QbS0]ITe#t";
$dbname = "ems";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>