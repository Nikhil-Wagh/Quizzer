<?php
include('session.php');
//error_reporting(0);
//include('connect.php');
if(!isset($_SESSION['handle']))
{
        ?>
        <script>
            alert("Please Login to continue");
            window.location.assign("login.php");
        </script>
        <?php
}
else
{
    $_SESSION['score']=0;
    $_SESSION['qno']=0;
    //echo $_SESSION['handle'];
    function getid($conn)
    {
        $sql = "SELECT tqno,qbid,time FROM examdetails WHERE id = ".$_SESSION['examid'];
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $_SESSION['end'] = time()+($row['time']-5)*60+5;
        $_SESSION['tqno'] = $row['tqno'];
        return $row['qbid'];
    }
    function create_array($conn2)
    {
        $_SESSION['questions'] =  array();
        $temp = array();
        $sql = "SELECT * FROM id593597_questionbank.".$_SESSION['qbid'];
        $result = mysqli_query($conn2,$sql);
        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_array($result))
            {
                array_push($temp,$row['qno']);
            }
        }
        shuffle($temp);
        for($i=0;$i<$_SESSION['tqno'];$i++)
        {
            $_SESSION['questions'][$i] = $temp[$i];
           // echo $_SESSION['questions'][$i]." ";
        }
        if($i==$_SESSION['tqno'])
            return true;
        return false;
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

            $sql = "INSERT INTO id593597_quizzer.".$_SESSION['examid']." VALUES ('".$_SESSION['handle']."',0,0)";
            //echo $sql;
            if(!mysqli_query($conn,$sql))
            {
                ?>
                <script>
                     alert("You have already submitted the test, you are not allowed to give it again.");
                     window.location.assign('index.php');
                </script>
                <?php
            }
            else
            {
                if(create_array($conn2))
                {
                    ?>
                    <script>window.location.assign("displayQuestion.php");</script>
                    <?php
                }
                else
                {
                    echo "Something went wrong. Please try again";
                    ?>
                    <script>window.location.assign("index.php");</script>
                    <?php
                }
            }
        }
    }
    if(isset($_POST['btn-leader']))
    {
        $_SESSION['examid'] = $_POST['examid'];
        ?>
            <script>
                window.location.assign('leader.php');
            </script>
        <?php
    }
}
?>
<html lang ="en">
<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Start Test</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
</head>
<body>

<div class="container" style="height: 10vh;"></div>
<div class="container flex-center" style="height: 10vh;">
    <h1 class="display-4"> Conduct Quiz </h1>
</div>
<div class="container" style="height: 20vh;"></div>
<div class="container" style="height: 60vh;">
    <form  method="post">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <h4 style="text-align: center;"><small> Select Quiz </small></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="dropdown" >
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
                            else
                            {
                                ?>
                                <script>
                                    alert("No Tests are On Going. Create your own.");
                                    window.location.assign('hostexam.php');
                                </script>
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
                <button class="btn btn-danger" type="submit" name="btn-start" id="btn-start" style="margin: auto; display: block;"> Begin </button>
                <button class="btn btn-success" type="submit" name="btn-leader" id="btn-leader" style="margin: auto; display: block;margin-top:8px;"> Leader Board </button>
            </div> 
        </div>
    </form>
</div>

</body> 
</html>
