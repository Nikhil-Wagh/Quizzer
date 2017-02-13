<?php
include('session.php');
if(isset($_SESSION['handle']))
{
    echo "Welcome ".$_SESSION['handle'];
}
function createqbtable($conn)
{
    $sql = "SELECT * FROM qbdetails WHERE handle = '".$_SESSION['handle']."'";
    //echo $sql;
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_array($result))
        {
            $_SESSION['qbid']=$row['id'];
        }
    }
    $crt = "CREATE TABLE questionbank.".$_SESSION['qbid']."(
    qno int(11) PRIMARY KEY AUTO_INCREMENT,
    question text(500),
    a text(500),
    b text(500),
    c text(500),
    d text(500),
    correct int(11),
    cmarks int(11),
    inmarks int(11))";
    //echo $crt;
    if(mysqli_query($conn,$crt))
    {
        return true;
    }
    else
        return false;
}
if(isset($_POST['btn-db']))
{
    $qbname=mysqli_real_escape_string($conn,$_POST['qbname']);
    $sql = "INSERT INTO qbdetails (handle,qbname) VALUES ('".$_SESSION['handle']."','".$qbname."')";
    //echo $sql;
    if(mysqli_query($conn,$sql))
    {
        if(createqbtable($conn))
        {
            ?>
            <script>
                alert("Question bank created Successfully. Start adding questions to it.");
                window.location.assign("selectqb.php");
            </script>
            <?php
        }
        else
        {
            echo "Error Creating Question Bank.<br>Please Try again.";
        }
    }
    else
    {
        ?>
        <script>
            alert("Please Login/Signup to create a database.");
            window.location.assign("SignUp.php");
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang ="en">
<head>
<title>Create your database</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
</head>
    
    
<style>
    .container{
        padding: 80px 120px
    }
    .carousel-inner img{
        -webkit-filter: grayscale(90%);
    filter: grayscale(90%); 
    width: 50%; 
    margin: auto;
    }
    .carousel-caption h3 {
    color: #fff !important;
    }
    @media (max-width: 600px) {
    .carousel-caption {
        display: none;
    }
    .view{
        background: url("https://static.pexels.com/photos/52993/chess-game-strategy-intelligence-52993.jpeg") center fixed;            background-size: cover;
    }
        
}
</style>
    <div class="container">
        <h1 class=" display-1 flex-center">Quizer</h1>
        <medium class="animated fadeInUp text-muted flex-center">Want to host a Online Competition? You have come just to the right place.</medium>
    </div>
         
<body>
    <?php
    $checksql="SELECT id FROM qbdetails WHERE handle= '".$_SESSION['handle']."'";
    //echo $checksql;
    $result=mysqli_query($conn,$checksql);
    if(mysqli_num_rows($result)>0)
    {
        while($rows=mysqli_fetch_array($result))
        {
            if($rows['id']!=NULL)
            {
                ?>
                <h1 class="display-4">You already have a database.</h1>
                <p>Click the button to add questions to your existing questionbank.</p>
                <a class="btn btn-primary waves-effect waves-light" href="addquestion.php">Add Questions</a>
                <?php
            }
        }
    }
    ?>
    <form method = "post">
    <p>
        <label for="qbname" >Question Bank Name</label>
        <input id="qbname" name="qbname" required="required" type="text">
    </p>
    <button class="btn btn-primary waves-effect waves-light" type="submit" id="btn-db" name="btn-db">Create your Database</button>
    </form>
    <a class="btn btn-primary waves-effect waves-light " type="button"  href="hostexam.php">Host Exam</a >
    <br><br>    
    <a class="btn btn-danger waves-effect waves-light " type="button"  name="btn-login" id="btn-login" href="login.php">LogIn</a >
    <a class="btn btn-danger waves-effect waves-light " type="button"  name="btn-signup" id="btn-signup" href="SignUp.php">SignUp</a >
    <a class="btn btn-danger waves-effect waves-light " type="button"  name="btn-logout" id="btn-logout" href="logout.php">Log Out</a >
    <form method="post">
    <div class="col-sm-4">
    <div class="card">
        <div class="card-block flex-center" style="margin-top: 20px; display='table';">
            <h3 class="card-title">Exam name</h3>
            <p class="card-text">Organisation name</p>
            <a class="btn btn-danger waves-effect waves-light " type="submit" href="startTest.php" name="btn-submit" id="btn-submit" >Start Test</a>
        </div>
    </div> 
    </div>
   </form> 
    
    <!--
    Ye comment kiya hai but ye chahiye. Isse delete nai krna
    <div class="container text-center" style="margin-top: 10px;">
        <h4>Made By</h4>     
        <div class="row"> 
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="card">
	    			<div class="view overlay">
	    				<img src="1.jpg" class="img-fluid" >
	    				<div class="mask pattern-4">
                            <h1 class="display-2 flex-center" style="color: #fff;">Nikhil Wagh</h1>
                        </div>
	    			</div>
	    			<div class="card-block" style="margin-top: 20px;">
	    				<h4 class="card-title">Programmer, Android Developer</h4>
	    				<p class="card-text"> Loves Math </p>
	    				<a class="btn btn-primary" href="#"> Button </a> 
	    			</div>
	    		</div>
            </div>
        </div>
    </div>-->
         
</body>
    
    
</html>
