<?php
include('session.php');
//error_reporting(0);
if(isset($_POST['btn-edit']))
{
    $sql = "UPDATE id593597_questionbank.".$_SESSION['qbid']." SET question = '".$_POST['question']."', a = '".$_POST['a']."', b = '".$_POST['b']."', c = '".$_POST['c']."', d = '".$_POST['d']."', correct = '".$_POST['radiobutton']."', cmarks = '".$_POST['cmarks']."', inmarks = '".$_POST['inmarks']."' WHERE qno = ".$_SESSION['questions'][$_SESSION['qno']-1];
    
    if(mysqli_query($conn2,$sql))
    {
        ?>
        <script>
            alert("Question updated successfully.");
            window.location.assign("editquestion.php");
        </script>
        <?php
    }
    else
    echo "Could Not Update.Please try again";
}
if(isset($_POST['btn-del']))
{
    $sql = "DELETE FROM id593597_questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['questions'][$_SESSION['qno']-1];
    if(mysqli_query($conn2,$sql))
    {
        ?>
        <script>
            alert("Question Deleted successfully.");
            window.location.assign("editquestion.php");
        </script>
        <?php
    }
    else
    echo "Could Not Delete.Please try again";
}
?>
