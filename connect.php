<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn= mysqli_connect($servername,$username,$password);

// Check connection
if (mysqli_connect_errno()) {
    echo "Error connection to MySql";
} 
mysqli_select_db($conn,"quizzer");
?>