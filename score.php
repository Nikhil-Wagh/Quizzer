<?php
    include("session.php");
//error_reporting(0);
//echo $_SESSION['qno'];
function calmarks($conn2,$selected)
{
    $sql = "SELECT correct,cmarks,inmarks FROM id593597_questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['questions'][$_SESSION['qno']-1];
    //echo $sql;
    $result = mysqli_query($conn2,$sql);
    $row = mysqli_fetch_array($result);
    if($selected==$row['correct'])
    {
        $_SESSION['score']+=$row['cmarks'];
    }
    else if($selected!=0)
    {
        $_SESSION['score']-=$row['inmarks'];
    }
}
function update($conn)
{
    $sql = "UPDATE id593597_quizzer.".$_SESSION['examid']." SET score = ".$_SESSION['score'].", attempted = ".($_SESSION['qno'])." WHERE handle = '".$_SESSION['handle']."'";
    //echo $sql;
    if(mysqli_query($conn,$sql))
    {
        //Place notification code here 
    }
}
if(isset($_POST['btn-next']))
{
    $_SESSION['qno']++;
    if(isset($_POST['radiobutton']))
    {
        $selected = $_POST['radiobutton'];
        calmarks($conn2,$selected);
       
    }
    update($conn);
    header("Location: displayQuestion.php");
   //die();
}

if(isset($_POST['btn-submit']))
{
    $_SESSION['qno']++;
    if(isset($_POST['radiobutton']))
    {
        $selected = $_POST['radiobutton'];
        calmarks($conn2,$selected);
        ?>
        <script type="text/javascript">
        alert("Your final score is "+ '<?php echo $_SESSION['score'] ?>')</script>
        <?php
    }
    update($conn);
}
?>

<html lang ="en">
<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<title>Test</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">

</head>
<body>
    <form action="leader.php" method="post">
    <div class ="container" style ="height:20vh;">
    <div class ="container" style="height: 60vh;">
  <div class="row">

		<div class="col-md-12">
                
	            <h4  style="text-align:center;">
			Click the button below to see the leader board
		     </h4>
             

		</div>

	</div>
        <div class="row">
            <div class="col-md-12 flex-center">
            <button class="btn btn-dark-green waves-effect waves-light " type="submit" name="btn-leader" id="btn-leader" >Leader Board</button>
        </div>
        </div>
    </form>
    </body>
</html>
