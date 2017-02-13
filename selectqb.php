<?php
include("session.php");
if(!isset($_SESSION['handle']))
{
    ?>
    <script>
        alert("Please Sign-up/Log-in to continue");
        window.location.assign("SignUp.php");
    </script>
    <?php
}

if(isset($_POST['btn-selectqb']))
{
    $_SESSION['qbid']=$_POST['qbid'];
    header("Location: addquestion.php");
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
<body>


<form  method="post">
    <div class="dropdown" >
        <select class="form-control" name="qbid">  
            <?php
                $sql="SELECT * FROM qbdetails WHERE handle = '".$_SESSION['handle']."'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0)
                {
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row['id']."'>".$row['qbname']."</option>";
                    }
                }
                else
                {
                    ?>
                    <script>alert("Please create a question bank.");</script>
                    <?php
                }
            ?>
         </select>  
    </div>
    <button class="btn btn-danger waves-effect waves-light" type="submit"  name="btn-selectqb" id="btn-selectqb" >Select Question Bank</button>   
</form>
</body> 
</html>