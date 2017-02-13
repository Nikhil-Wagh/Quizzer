<?php
include('session.php');
//include('connect.php');
if(!isset($_SESSION['handle']))
{
        ?>
        <script>alert("Please Login to continue");</script>
        <?php
        header("Location: login.php");
}
$_SESSION['score']=0;
$_SESSION['qno']=0;
//echo $_SESSION['handle'];
function getid($conn)
{
    $sql = "SELECT tqno,qbid FROM examdetails WHERE id = ".$_SESSION['examid'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['tqno'] = $row['tqno'];
    return $row['qbid'];
}
if(isset($_POST['btn-start']))
{
    $_SESSION['examid']=$_POST['examid'];
    $_SESSION['qbid'] = getid($conn);
    if(!$_SESSION['qbid'])
    {
        ?>
        <script>alert("Error Occured. Please try again.");</script>
        <?php
    }
    else
    {
        $sql = "INSERT INTO quizzer.".$_SESSION['examid']." VALUES ('".$_SESSION['handle']."',0,0)";
        //echo $sql;
        if(!mysqli_query($conn,$sql))
        {
            ?>
            <script>alert("You cannot give this test.Please try for some other Test or contact your administrator.");</script>
            <?php
        }
        else
        {
            ?>
            <script>window.location.assign("displayQuestion.php");</script>
            <?php
        }
    }
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
        <label for = "qbname">Select Exam</label>
        <select class="form-control" name="examid">  
            <?php
                $sql="SELECT * FROM examdetails";     
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0)
                {
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row['id']."'>".$row['examname']."</option>";
                    }
                }
            ?>
         </select>  
    </div>
    <button class="btn btn-danger waves-effect waves-light" type="submit"  name="btn-start" id="btn-start" >Start Test</button>   
</form>
</body> 
</html>