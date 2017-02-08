<?php
include("session.php");
 
//if(isset($_REQUEST['btn-save']))
{
    $count=0;
    $sqlcount="SELECT qno FROM questionbank";
    $temp = mysqli_query($conn,$sqlcount);
    if(mysqli_num_rows($temp)>0)
    {
        while($row=mysqli_fetch_assoc($temp))
            $count++;
    }
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
        $ans=0;
    if($ans<=0)
    {
        ?>
       <script>alert("Correct Answer required.");</script>
            <?php
        return ;
    }
    
    if($conn->query("INSERT INTO ."$_SESSION['handle']."". VALUES('$count','$q','$op1','$op2','$op3','$op4','$ans')"))
    {
        ?>
       <script>alert("Question Added successfully to your database.");</script>
        <script>
            {
                window.location.assign("addquestion.php");
            }
        </script> 

        <?php
        
    }
    else 
        echo "Error while saving the Question";
   //echo "<script>setTimeout(\"location.href = 'addquestion.php';\",0);</script>";

}

?>