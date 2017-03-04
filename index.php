<?php
include('session.php');
//error_reporting(0);
//echo $_SESSION['handle'];
/*if(isset($_SESSION['handle']))
{
    echo "Welcome ".$_SESSION['handle'];
}*/
function createqbtable($conn,$conn2)
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
    $crt = "CREATE TABLE id593597_questionbank.".$_SESSION['qbid']."(
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
    if(mysqli_query($conn2,$crt))
    {
        return true;
    }
    else
        return false;
}
if(isset($_POST['btn-db']))
{
    $qbname=mysqli_real_escape_string($conn,$_POST['qbname']);
    if(!isset($_SESSION['handle']))
    {
        ?>
        <script type="text/javascript">
            alert("Please Login/Signup to continue.");
            window.location.assign('login.php');
        </script>
        <?php
    }
    else
    {
        $sql = "INSERT INTO qbdetails (handle,qbname) VALUES ('".$_SESSION['handle']."','".$qbname."')";
        //echo $sql;
        if(mysqli_query($conn,$sql))
        {
            if(createqbtable($conn,$conn2))
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
}
if(isset($_POST['btn-mail']))
{
    $msg = "Name: ".$_POST['name'].".\n"."Email: ".$_POST['email']."\n"."Comment :".$_POST['comments'];
    //echo $msg;
    ?>
    <script>
        alert("Your message have been recieved by us, we will get back to you shortly.");
        //alert('');
        location = 'index.php';
    </script>
    <?php
    mail("nikhilwagh.work@gmail.com","Quizzer Comment",$msg);
}
?>
<!DOCTYPE html>
<html lang ="en">

<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta property="og:url" content="https://wagh.000webhostapp.com/" />
    <meta property="og:title" content="Quizzer" />
    <meta property="og:description" content="Host online quiz for free, unlimited questions and multiple quizes can be organised simultaneously" />
    <meta property="og:image" content ="Quizzer.png" />
    <meta name="google-site-verification" content="43doVjdApqM5sbCiKIfKyKPau30tlevauSQLRWhtHtQ" />
    <title> Quizzer </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <style type="text/css">
        .navbar 
        {
            background: #4285F4;
        }
        .top-nav-collapse
        {
            background: #4285F4;
        }
        @media only screen and (max-width: 768px)
        {
            .navbar 
            {
                background: #4285F4;
                opacity: 1;
            }
        }
        .view 
        {
            background: url("https://static.skillshare.com/uploads/parentClasses/81608683dfc8cfa15ed91a29e447839d/7e55b03a")center fixed;
            background-size: cover;
        }
    </style>
    
   <script type="application/ld+json">
{
  
  "@type": "Online Quiz",
  "description": "Host online quiz for free.Create your own question bank, add,edit or delete questions from your question bank. Host quiz and also monitor the realtime leader board.",
  "image":"https://static.skillshare.com/uploads/parentClasses/81608683dfc8cfa15ed91a29e447839d/7e55b03a",
  "url": "https://wagh.000webhostapp.com",
  "contactPoint": [{
    "@type": "ContactPoint",
    "mobile": "8007818864",
    "email": "nikhilwagh.work@gmail.com",
    "contactType": "customer service"
  }]
}
</script>
</head>

<body>
    
    <!-- Start your project here-->

    <header>
        <nav class="navbar navbar-dark navbar-fixed-top">
            <button class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#togg"> <span class="fa fa-bars"> </span> </button>
            <div class="container">
                <div class="collapse navbar-toggleable-xs" id="togg">
                    <a class="navbar-brand" href="index.php"> Quizzer </a>
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#create"> CreateDatabase </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="hostexam.php"> HostQuiz </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" type="submit" href="startTest.php" name="btn-submit" id="btn-submit"> ConductQuiz </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact"> Contact </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav nav-flex-icons">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/Waghuu"> <span class="fa fa-facebook"> </span> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/Nikhil-Wagh"> <span class="fa fa-github"> </span> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.instagram.com/waghuu/"> <span class="fa fa-instagram"> </span> </a>
                        </li>
                        <li class="nav-item" style="color: #fff; margin-top: 8px;">
                            <?php
                                if(isset($_SESSION['handle']))
                                {
                                    echo "Welcome ".$_SESSION['handle']." ";
                                }
                            ?>
                        </li>
                        <li class="nav-item">
                        <?php 
                        if(isset($_SESSION['handle']))
                            echo " <a class='btn btn-primary waves-effect waves-light nav-link' type='button' name='btn-logout' id='btn-logout' href='logout.php'>Log Out</a >";
                        ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="view hm-black-strong" style="height: 100vh; color: #fff;">
            <div class="full-bg-img flex-center">
                <div class="table">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <h1 class="animated fadeInUp display-4"> Want to conduct a quiz online? </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-default" type="button" name="btn-login" id="btn-login" href="login.php" style="float: right;">Login</a>
                        </div>
                        <div class="col-sm-6">
                            <a class="btn btn-default" type="button" name="btn-signup" id="btn-signup" href="SignUp.php">SignUp</a >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

<div class="container-fluid flex-center" style="height: 50vh;" id="create">
    <form method="post">
        <div class="table">
            <div class="row">
                <div class="col-md-12" style="text-align: center;">
                    <label for="qbname" class="h2-responsive">Question Bank Name</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input id="qbname" name="qbname" required="required" type="text" placeholder="QB_Name">
                </div>
                <div class="col-sm-12 flex-center">
                    <button class="btn btn-success" type="submit" id="btn-db" name="btn-db">Create your Database&nbsp;&Xi;</button>
                </div>
            </div>
        </div>    
    </form>
</div>

<div class="container" style="height: 2px; background: #333;"></div>

<div class="container-fluid" style="height: 30vh;">
    <?php
        if(isset($_SESSION['handle']))
        {
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
                        <br>
                        <div class="table">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 style="text-align: center;">You already have a database.</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 style="text-align: center;">Click the button to add questions to your existing questionbank.</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="btn btn-primary waves-effect waves-light" href="selectqb.php" style="float: right;">Add Questions</a>
                                </div>
                                <div class="col-sm-6">
                                    <form method="post" action="selectqbedit.php">
                                        <button class="btn btn-primary" type= "submit" name="btn-edit" id="btn-edit">Edit Questions</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }
                }
            } 
        }
    ?>
</div>

<div class="container" style="background: #333; width: 100%; color: #fff;" id="contact">
    <div class="row flex-center">
        <h4 class="display-4" style="padding-top: 20px;">Contact</h4>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-4">
            <div class="container" style="margin-left: 50px;">
                <h4>&nbsp;</h4>
                <h6><strong> Mob </strong> | 8007818864</h6>
                <h6><strong> Email </strong> | contact@nikhilwagh.work@gmail.com</h6>
                <h6><strong> Address </strong> | Pune, Maharashtra</h6>
            </div>
        </div>
        <div class="col-md-8">
            <form method="post">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="name" name="name" style="color: #fff;" placeholder="Name" type="text" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="email" name="email" style="color: #fff;" placeholder="Email" type="email" required>
                    </div>
                </div>
                <textarea class="md-textarea" id="comments" name="comments" style="color: #fff;" placeholder="Comment" rows="5"></textarea>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button class="btn btn-danger pull-right" type="submit" id="btn-mail" name="btn-mail">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid flex-center" style="height: 7vh; background: #333; color: #fff;">
    &copy; <a style="color: #fff;" href="https://opensource.org/licenses/BSD-3-Clause"> 2017 Prototype/Quizzer </a>
</div>

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
