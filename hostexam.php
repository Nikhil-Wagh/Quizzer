<?php
include("session.php");
//error_reporting(0);
if(!isset($_SESSION['handle']))
{
    ?>
    <script>
        alert("Please Login to Create Database");
        window.location.assign("login.php");
    </script>
    <?php
    
}
else
{
    function insert($conn,$oname,$ename,$total,$time)
    {
         $sql = "INSERT INTO examdetails (handle, qbid, examname, orgname, tqno,time) VALUES ('".$_SESSION['handle']."',".$_SESSION['qbid'].",'".$ename."','".$oname."',".$total.",".$time.")";
        //echo $sql;
        if(mysqli_query($conn,$sql))
        {
            $sql = "SELECT * FROM examdetails WHERE handle = '".$_SESSION['handle']."'";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0)
            {
                while($row=mysqli_fetch_array($result))
                {
                    $_SESSION['examid']=$row['id'];
                }
            }
            return true;
        }
        return false;
    }
    function createtable($conn)
    {
        $table="CREATE TABLE id593597_quizzer.".$_SESSION['examid']." (
            handle VARCHAR(50) PRIMARY KEY,
            score INT(11),
            attempted INT(11))";
        //echo $table;
         if(mysqli_query($conn,$table))
         {
             return true;
         }
        return false;
    }
    if(isset($_POST['btn-host']))
    {
        $oname = mysqli_real_escape_string($conn,$_POST['oname']);
        $ename = mysqli_real_escape_string($conn,$_POST['ename']);
        $total = mysqli_real_escape_string($conn,$_POST['total']); 
        $time = mysqli_real_escape_string($conn,$_POST['time']); 
        $_SESSION['qbid'] = mysqli_real_escape_string($conn,$_POST['qbid']);
        $error=false;
        if(insert($conn,$oname,$ename,$total,$time))
        {
            if(!createtable($conn))
            {
                $error=true;
            }
        }
        else 
        {
            $error = true;
        }
        if($error)
        {
            ?>
            <script>alert("Error Hosting Exam.Please try again.");</script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert("Exam hosted Successfully");
                window.location.assign("index.php");
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang ="en">
<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<title>Host Quiz</title>
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
        <h1 class="display-4"><small>Want to host a competition?</small> Create Quiz </h1>
            <p>
                <label for="ename" >Exam Name</label>
                <input id="ename" name="ename" required="required" type="text">
            </p>
            <p>
                <label for="oname" >Organisation Name</label>
                <input id="oname" name="oname" required="required" type="text">
            </p>
             <div class="dropdown" >
                 <label for ="qbid">Select Question Bank</label>
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
                            <script>
                                alert("Please create a question bank.");
                                location = 'index.php#create';
                            </script>
                            <?php
                        }
                    ?>
                 </select>  
            </div>
            <p>
                <label for="total" >Total number of questions in exam</label>
                <input id="total" name="total" required="required" type="number" min="1">
            </p>
            <p>
                <label for="total" >Time (in min)</label>
                <input id="time" name="time" required="required" type="number" min="1">
            </p>
            <div class="flex-center" style="height: 10vh;">
                <button class="btn btn-primary" type="submit" name="btn-host" id="btn-host" >Host Exam</button>
            </div>
            </form>
    </div>
</body>
</html>
