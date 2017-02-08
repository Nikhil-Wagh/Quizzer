<?php
include("session.php");
if($_SESSION['handle']==NULL)
{
    ?>
    <script>alert("Please Login to Create Database");</script>
    <?php
    header("Location: login.php");
}
if(isset($_POST['btn-add']))
{
    $sql="UPDATE user SET questionbank= '".$_POST['qbname']."',orgname='".$_POST['oname']."',examname='".$_POST['ename']."' WHERE handle='".$_SESSION['handle']."'";
    if(mysqli_query($conn,$sql))
    {
        $table="CREATE TABLE ".$_SESSION['handle']."".$_POST['qbname']." (
        qno INT(11) AUTO_INCREMENT PRIMARY KEY,
        question TEXT(500),
        a TEXT(200),
        b TEXT(200),
        c TEXT(200),
        d TEXT(200),
        correct INT(1))";
        //echo $table;
        if(mysqli_query($conn,$table))
        {
            ?>
            <script>alert("Question Bank created Successfully");</script>
            <?php
            echo "hello ";
            header("Location: addquestion.php");
        }
        else goto here; 
    }
    else
    {here:
        ?>
        <script>alert("Error Creating Question Bank.Please try again");</script>
        <?php
        header("Location :index.html");
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
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<style>
    .container{
            padding-left: 30%;
            padding-right: 30%;
            padding-top: 5%;
            margin: auto;
            display: block;
        }
    .btn{
        float: center;
    }
    </style>
<body>
    <div class="container">
        <form method="post">
        <h1 class="display-4"><small>Want to host a competition?</small>Create Question Bank </h1>
            <p>
                <label for="ename" >Exam Name</label>
                <input id="ename" name="ename" required="required" type="text">
            </p>
            <p>
                <label for="oname" >Organisation Name</label>
                <input id="oname" name="oname" required="required" type="text">
            </p>
            <p>
                <label for="qbname" >Question Bank</label>
                <input id="qbname" name="qbname" required="required" type="text">
            </p>
            <button class="btn btn-primary waves-effect waves-light " type="submit"  name="btn-add" id="btn-add" >Add Questions</button>
            </form>
    </div>
</body>
</html>