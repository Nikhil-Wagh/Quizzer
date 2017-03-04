<?php
//error_reporting(0);
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
    $_SESSION['qno']=0;  
    $_SESSION['qbid']=$_POST['qbid'];
    $_SESSION['questions']=array();
    $sql = "SELECT * FROM id593597_questionbank.".$_SESSION['qbid'];
    $result = mysqli_query($conn2,$sql);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_array($result))
        {
            array_push($_SESSION['questions'],$row['qno']);
        }
    }
    ?>
    <script>
        window.location.assign("editquestion.php");
    </script>
    <?php
}
/*if(isset($_POST['btn-edit']))
{
    $_SESSION['qno']=0;  
}*/
?>
<html lang ="en">
<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Create your Question Bank</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="height: 10vh;"></div>
<div class="container flex-center" style="height: 10vh;">
    <h1 class="display-4"> Edit Questions </h1>
</div>
<div class="container" style="height: 20vh;"></div>
<div class="container" style="height: 60vh;">
    <form  method="post">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <h4 style="text-align: center;"><small> Select Question Bank </small></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="dropdown">
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
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-sm-12" >
                <button class="btn btn-danger" type="submit" name="btn-selectqb" id="btn-selectqb" style="margin: auto; display: block;"> Edit Questions </button>
            </div> 
        </div>
    </form>
</div>
</body> 
</html>
