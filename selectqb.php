<?php
include("session.php");
//error_reporting(0);
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
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Select Question Bank</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
</head>
<body>

<div class="container" style="height: 10vh;"></div>
<div class="container flex-center" style="height: 10vh;">
    <h1 class="display-4"> Select Question Bank </h1>
</div>
<div class="container" style="height: 20vh;"></div>
<div class="container" style="height: 60vh;">
    <form  method="post">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <h4 style="text-align: center;"><small> Add questions to the following question bank </small></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="dropdown" style="width: 50%; margin: auto; display: block;">
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
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-danger" type="submit"  name="btn-selectqb" id="btn-selectqb" style="margin: auto; display: block;">Enter</button>
            </div> 
        </div>
    </form>
</div>

</body>
</html>
