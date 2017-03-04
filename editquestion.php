<?php
include('session.php');
error_reporting(0);
//echo $_SESSION['qbid'];
if(!isset($_SESSION['handle']))
{
    ?>
        <script>
            alert("Please Login to continue");
            window.location.assign("login.php");
        </script>
    <?php
    header('Location: index.php');
    exit();
}
$_SESSION['qno']++;
$qno = $_SESSION['qno']-1;
//echo $qno." kk ";
function countnq($conn2)
{
    $sql = "SELECT COUNT(*) FROM id593597_questionbank.".$_SESSION['qbid'];
    $result = mysqli_query($conn2,$sql);
    if(!$result)
    {
       echo "Some Error occured.Please try again.";
       echo $sql;
    }
    $row = mysqli_fetch_array($result);
    //echo $row['COUNT(*)'];
    return $row['COUNT(*)'];
}
if($qno>=countnq($conn2))
{
    ?>
    <script>    
        alert("All questions updated, Add more questions to your database from home.");
        window.location.assign("index.php");
    </script>
    <?php
}
else
{
    $sql = "SELECT * FROM id593597_questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['questions'][$qno];
    //echo $sql;
    $result= mysqli_query($conn2,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['question']=$row['question'];
        $_SESSION['a']=$row['a'];
        $_SESSION['b']=$row['b'];
        $_SESSION['c']=$row['c'];
        $_SESSION['d']=$row['d'];
        $_SESSION['correct']=$row['correct'];
        $_SESSION['cmarks']=$row['cmarks'];
        $_SESSION['inmarks']=$row['inmarks'];
    }
}
?>
<!DOCTYPE html>
<html lang ="en">
<head>
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<title>Edit Questions</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
</head>
<script type="text/javascript">
    function expandtext(expand) {
        while (expand.rows > 1 && expand.scrollHeight < expand.offsetHeight) {
            console.log("display all rows!") >
        }
    }
</script>
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<style>
    .md-form{
        padding: 10px;
        margin: auto;
    }
    .row{
        padding: 10px;
        margin: auto;
    }
    .btn{
        margin: auto;
        float : left;
    }
    
    </style>
    <body>   
        <form id="statement" action="saveedit.php" method="post">
            <div id="stage"> </div>
            <h4><strong>Question no. <?php echo $_SESSION['qno'] ?></strong></h4>
            <div class="form-group flex-center">
                <textarea type="text" name="question" id="question" class="form-control"  data-toggle="tooltip" data-placement="bottom" title="Enter your Question in this textarea." rows="8" class="form-control" rows="4" style="border: none; width: 90%;" onkeydown="expandtext(this);"><?php echo $_SESSION['question'] ?></textarea>  
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="a">Option A</label>
                    <textarea type="text" name="a" id="a" class="form-control" rows="4" class="form-control" value="<?php echo $_SESSION['a'] ?>"><?php echo $_SESSION['a'] ?></textarea>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox1" value="1" <?php if($_SESSION['correct']==1){echo 'checked';} ?> >
                        <label for="checkbox1">Correct Answer</label> 
                    </fieldset>
                </div>
                <div class="col-sm-3">
                    <label for="b">Option B</label>
                    <textarea type="text" name="b" id="b" class="form-control" rows="4" class="form-control" value="<?php echo $_SESSION['b'] ?>"><?php echo $_SESSION['b'] ?></textarea>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox2" value="2" <?php if($_SESSION['correct']==2){echo 'checked';} ?> >
                        <label for="checkbox2">Correct Answer</label> 
                    </fieldset>
                </div>
                <div class="col-sm-3">
                    <label for="c">Option C</label>
                    <textarea type="text" name="c" id="c" class="form-control" rows="4" class="form-control" value="<?php echo $_SESSION['c'] ?>"><?php echo $_SESSION['c'] ?></textarea>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox2" value="3" <?php if($_SESSION['correct']==3){echo 'checked';} ?> >
                        <label for="checkbox3">Correct Answer</label> 
                    </fieldset>
                </div>
                <div class="col-sm-3">
                    <label for="d">Option D</label>
                    <textarea type="text" name="d" id="d" class="form-control" rows="4" class="form-control" value="<?php echo $_SESSION['d'] ?>"><?php echo $_SESSION['d'] ?></textarea>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox4" value="2" <?php if($_SESSION['correct']==4){echo 'checked';} ?> >
                        <label for="checkbox4">Correct Answer</label> 
                    </fieldset>
                </div>
            </div>
            <div class="row" style=",margin-top: 20px;">
                <div class="col-sm-6">
                    <h4><strong>Marks for Correct Answer</strong></h4>
                    <input type = "text" name="cmarks" id="cmarks" class="form-control" value="<?php echo $_SESSION['cmarks'] ?>">
                </div>
                <div class="col-sm-6">
                    <h4><strong>Marks for Incorrect Answer</strong></h4>
                    <input type = "text" name="inmarks" id="inmarks" class="form-control" value="<?php echo $_SESSION['inmarks'] ?>">
                </div>
            </div>
            <div class="row flex-center">
                <div class="btn-group btn-group-lg">
                    <button class="btn btn-default" type="reset" name="btn-clear" id="btn-clear">Clear</button>
                    <button class="btn btn-primary" type="submit" name="btn-edit" id="btn-edit">Save</button>
                    <button class="btn btn-danger" type="submit" name="btn-del" id="btn-del">Delete</button>
                    <a class="btn btn-success" type="button" name="btn-home" id="btn-home" href="index.php">Home</a>
                </div>
            </div>
        </form>
</body>
</html>
