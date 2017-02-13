<?php
include("session.php");
 
//if(isset($_REQUEST['btn-save']))
{
    $count=0;
    $sqlcount="SELECT COUNT(*) FROM questionbank.".$_SESSION['qbid'];
    $temp = mysqli_query($conn,$sqlcount);
    $row = mysqli_fetch_array($temp);
    $count = $row['COUNT(*)'];
    $count++;
    $ans=0;
    $q=$_REQUEST['quest'];
    $op1=$_REQUEST['opt1'];
    $op2=$_REQUEST['opt2'];
    $op3=$_REQUEST['opt3'];
    $op4=$_REQUEST['opt4'];
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
    $sql="INSERT INTO questionbank.".$_SESSION['qbid']." (question,a,b,c,d,correct,cmarks,inmarks) VALUES('$q','$op1','$op2','$op3','$op4',$ans,$cmarks,$inmarks)";
    //echo $sql;
    if(mysqli_query($conn,$sql))
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
        //echo "<script>setTimeout(\"location.href = 'addquestion.php';\",0);</script>";
    }   
}

?>