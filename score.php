<?php
    include("session.php");
    if(isset($_POST['btn-next']))
    {
        if(isset($_POST['radiobutton']))
        {
            if($_POST['radiobutton']==$_SESSION['correct'])
                $_SESSION['score']++;
           echo "<script>alert(".$_SESSION['score'].")</script>";
        }
       header("Location: displayQuestion.php");
       //die();
    }
    if(isset($_POST['btn-submit']))
    {
        $sql="INSERT INTO exam VALUES('Nikhil Wagh','".$_SESSION['handle']."',".$_SESSION['score'].")";
        //echo $sql;
        if(mysqli_query($conn,$sql))
        {
             echo "Your final score is : ".$_SESSION['score'];   
        }
        else 
        {
            echo "Your final score is : ".$_SESSION['score'];
            echo "<br>";
            echo "Error submitting your score, please contact the invigilator.";
        }
    }
?>