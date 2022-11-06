<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "makeup";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Something went wrong");
}



?>