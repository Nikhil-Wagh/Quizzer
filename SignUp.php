<?php
include_once("connect.php");
session_start();
if(isset($_SESSION['handle']))
{
    header("Location : index.html");
}
if(isset($_POST['btn-signup']))
   {
    $uname=$conn->real_escape_string($_POST['uname']);
    $handle= $conn->real_escape_string($_POST['handle']);
    $upass= $conn->real_escape_string($_POST['password']);
    $mob= $conn->real_escape_string($_POST['number']);
    $email = $conn->real_escape_string($_POST['email']);
    $clg= $conn->real_escape_string($_POST['college']);
    
    $result;
    $sql="INSERT INTO user VALUES ('$handle','$upass','$uname','$mob','$email','$clg')";
    //echo $sql;
    if($result=mysqli_query($conn,$sql))
    {
        $_SESSION['handle']=$handle;
        ?>
        <script>alert("Sign Up Successful!!");</script>
        <?php
        echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
    }
    else {
       ?>
        <script>alert("Handle already in use.Please try again.");</script>
        <?php
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
                <label for="emai" >Email id</label>
                <input id="email" name="email" required="required" type="email">
            </p>
            <p>
                <label for="ucollege" >College</label>
                <input id="ucollege" name="college" required="required" type="text">
            </p>
            <button class="btn btn-dark-green waves-effect waves-light " type="submit"  name="btn-signup" id="btn-signup" >SignUp</button>
            <label for="btn-login">Already have a account</label> 
            <button class="btn btn-dark-green waves-effect waves-light " type="button" style="align:left" name ="btn-login" href="login.php" >Log in</button>
        </form>
        </div>
    </body>
</html>