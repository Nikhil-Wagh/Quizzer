<?php
include_once("connect.php");
session_start();
//if($_SESSION['handle']!=NULL)
   {
   // header("Location : index.html");
}
if(isset($_POST['btn-login']))
   {
    $uname=$conn->real_escape_string($_POST['uname']);
    $handle= $conn->real_escape_string($_POST['handle']);
    $upass= $conn->real_escape_string($_POST['password']);
    $mob= $conn->real_escape_string($_POST['number']);
    $clg= $conn->real_escape_string($_POST['college']);
    $result;
    $sql="INSERT INTO user VALUES ('$handle','$uname','$upass','$mob','$clg',0,'','','')";
    //echo $sql;
    if($result=mysqli_query($conn,$sql))
    {
        ?>
        <script>alert("Login Successful!!");</script>
        <?php
        echo "<script>setTimeout(\"location.href = 'index.html';\",500);</script>";
    }
    else {
        echo "Error Signing-UP,contact the administrator.";
    }
}
?>
<html lang ="en">
<head>
<title>Test</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
    <style>
        .container{
            padding-left: 30%;
            padding-right: 30%;
            padding-top: 5%;
            margin: auto;
            display: block;
        }
        .btn-toolbar{
            margin: auto;
            float: right;   
        }
        .btn{
            float: right;
        }
    </style>
</head>
    <body>
    <div class="container">
        <form autocomplete="on" method="post">
            <h1 class="display-4">Sign-Up</h1>
            <p>
                <label for="username" >Name</label>
                <input id="uname" name="uname" required="required" type="text">
            </p>
            <p>
                <label for="handle" >Handle</label>
                <input id="handle" name="handle" required="required" type="text">
            </p>
            <p>
                <label for="password" >Password</label>
                <input id="password" name="password" required="required" type="password">
            </p>
            <p>
                <label for="unum" >Phone Number</label>
                <input id="unum" maxlength="10" name="number" required="required" type="tel">
            </p>
            <p>
                <label for="ucollege" >College</label>
                <input id="ucollege" name="college" required="required" type="text">
            </p>
             <button class="btn btn-dark-green waves-effect waves-light " type="submit"  name="btn-login" id="btn-login" >SignUp</button>
        </form>
        </div>
    </body>
</html>