<?php
    include("session.php");

function calmarks($conn,$selected)
{
    $sql = "SELECT correct,cmarks,inmarks FROM questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['qno'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    if($selected==$row['correct'])
    {
        $_SESSION['score']+=$row['cmarks'];
    }
    else
    {
        $_SESSION['score']-=$row['inmarks'];
    }
}
function update($conn)
{
    $sql = "UPDATE quizzer.".$_SESSION['examid']." SET score = ".$_SESSION['score'].", attempted = ".$_SESSION['qno']." WHERE handle = '".$_SESSION['handle']."'";
    //echo $sql;
    if(mysqli_query($conn,$sql))
    {
        //Place notification code here 
    }
}
if(isset($_POST['btn-next']))
{
    if(isset($_POST['radiobutton']))
    {
        $selected = $_POST['radiobutton'];
        calmarks($conn,$selected);
       
    }
    update($conn);
    header("Location: displayQuestion.php");
   //die();
}

if(isset($_POST['btn-submit']))
{
    if(isset($_POST['radiobutton']))
    {
        $selected = $_POST['radiobutton'];
        calmarks($conn,$selected);
        echo "<script>alert(".$_SESSION['score'].")</script>";
    }
    update($conn);
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
            padding: 10px;
            margin: auto;
            display: block;
        }
        .btn-toolbar{
            margin: auto;
            float: right;
        
            
        }
    </style>
</head>
<body>
    <form action="leader.php" method="post">
    <button class="btn btn-dark-green waves-effect waves-light " type="submit"  name="btn-leader" id="btn-leader" >Leader Board</button>
    </form>
    </body>
</html>
