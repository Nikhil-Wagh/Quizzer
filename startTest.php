<?php
include('session.php');
//include('connect.php');
$_SESSION['score']=0;
$_SESSION['qno']=0;

$sql="SELECT * FROM questionbank";
$r1= mysqli_query($conn,$sql);
$_SESSION['total']=0;
if(mysqli_num_rows($r1)>0)
{
    while($row=mysqli_fetch_array($r1))
        $_SESSION['total']++;
}

?>
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
    .md-form{
        padding: 10px;
        margin: auto;
    }
    .row{
        padding: 10px;
        margin: auto;
    }
    .btn{
        
        margin-top: 10%;
        display: table;
        align-self: center;
        
    }
    
    </style>
<a class="btn btn-danger waves-effect waves-light " type="submit" href="displayQuestion.php" name="btn-submit" id="btn-submit" >Start Test</a>
</html>


