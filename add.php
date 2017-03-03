<?php
include("session.php");
//error_reporting(0);
//if(isset($_REQUEST['btn-save']))
{
    $count=0;
    $sqlcount="SELECT COUNT(*) FROM id593597_questionbank.".$_SESSION['qbid'];
    $temp = mysqli_query($conn2,$sqlcount);
    $row = mysqli_fetch_array($temp);
    $count = $row['COUNT(*)'];
    $count++;
    $ans=0;
    $q=mysqli_real_escape_string($conn2,$_REQUEST['quest']);
    $op1=mysqli_real_escape_string($conn2,$_REQUEST['opt1']);
    $op2=mysqli_real_escape_string($conn2,$_REQUEST['opt2']);
    $op3=mysqli_real_escape_string($conn2,$_REQUEST['opt3']);
    $op4=mysqli_real_escape_string($conn2,$_REQUEST['opt4']);
    if(isset($_REQUEST['ans']))
        $ans=$_REQUEST['ans'];
    else 
    {
        ?>
       <script>alert("Correct Answer required.");</script>
            <?php
        return ;
    }
    $cmarks=$_REQUEST['cmarks'];
    $inmarks=$_REQUEST['inmarks'];
    $sql="INSERT INTO id593597_questionbank.".$_SESSION['qbid']." (question,a,b,c,d,correct,cmarks,inmarks) VALUES('$q','$op1','$op2','$op3','$op4',$ans,$cmarks,$inmarks)";
    //echo $sql;
    if(mysqli_query($conn2,$sql))
    {
        ?>
       <script>
           alert("Question Added successfully to your database.");
            {
                window.location.assign("addquestion.php");
            }
        </script> 

        <?php
        
    }
    else 
    {
        ?>
        <script>alert("Error saving the question.");</script>
        <?php
        echo $sql;
        //echo "<script>setTimeout(\"location.href = 'addquestion.php';\",0);</script>";
    }   
}

?>
