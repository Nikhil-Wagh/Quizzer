<?php
include('session.php');
//include('connect.php');
//echo $_SESSION['handle'];
if(!isset($_SESSION['handle']))
{
    if(isset($_POST['btn-login']))
    {
        $sql="SELECT * FROM user WHERE (handle = '".$_POST['handle']."' AND password = '".$_POST['password']."')";
        //echo $sql;
        if($result=mysqli_query($conn,$sql))
        {
            $row=mysqli_fetch_array($result);
            $_SESSION['handle']=str_replace(' ','',$row['handle']);
            ?>
                <script type="text/javascript">  
                    var temp = "Hello"; 
                    alert("Login Successfull "+'<?php echo $_SESSION['handle'] ?>');
                    window.location.assign("index.php");
                </script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert("Handle not recognized.Please input correct data or sign up to register.");
                window.location.assign("login.php");
            </script>
            <?php
        }
    }
}
else
{
    //echo $_SESSION['handle'];
    ?>
    <script>    
    alert("Already Logged In");
    window.location.assign("index.php");
    </script>
    <?php
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
            <h1 class="display-4">Log-In</h1>
            <p>
                <label for="handle" >Handle</label>
                <input id="handle" name="handle" required="required" type="text">
            </p>
            <p>
                <label for="password" >Password</label>
                <input id="password" name="password" required="required" type="password">
            </p>
            <a class="btn btn-dark-green waves-effect waves-light " type="button" href="SignUp.php" >Sign Up</a>
             <button class="btn btn-dark-green waves-effect waves-light " type="submit"  name="btn-login" id="btn-login" >Login</button>
        </form>
        </div>
    </body>
</html>