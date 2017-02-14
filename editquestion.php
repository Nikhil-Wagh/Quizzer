<?php
include('session.php');
//error_reporting(0);
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
echo $qno." kk ";
function countnq($conn)
{
    $sql = "SELECT COUNT(*) FROM questionbank.".$_SESSION['qbid'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo $row['COUNT(*)'];
    return $row['COUNT(*)'];
}
if($qno>=countnq($conn))
{
    ?>
    <script>    
        alert("All questions updated, Add more questions to your database from home.");
        //window.location.assign("index.php");
    </script>
    <?php
}
else
{
    $sql = "SELECT * FROM questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['questions'][$qno];
    //echo $sql;
    $result= mysqli_query($conn,$sql);
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
<title>Create your database</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
</head>
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
    <div class="md-form">
        <textarea type="text" name="question" id="question" class="md-textarea"  data-toggle="tooltip" data-placement="bottom" title="Enter your Question in this textarea." ><?php echo $_SESSION['question'] ?></textarea>
        <label for="question">Question no. <?php echo $_SESSION['qno'] ?></label>
        
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="a" id="a" class="form-control" value="<?php echo $_SESSION['a'] ?>">
                <label for = "a" >Option A</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox1" value="1" <?php if($_SESSION['correct']==1){echo 'checked';} ?> >
                        <label for="checkbox1">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="b" id="b" class="form-control" value="<?php echo $_SESSION['b'] ?>">
                <label for = "b" >Option B</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox2" value="2" <?php if($_SESSION['correct']==2){echo 'checked';}?> >
                        <label for="checkbox2">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="c" id="c" class="form-control" value="<?php echo $_SESSION['c'] ?>">
                <label for = "c" >Option C</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox3" value="3" <?php if($_SESSION['correct']==3){echo 'checked';}?> >
                        <label for="checkbox3">Correct Answer</label>
                      
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="d" id="d" class="form-control" value="<?php echo $_SESSION['d'] ?>">
                <label for = "d" >Option D</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox4" value="4" <?php if($_SESSION['correct']==4){echo 'checked';}?> >
                        <label for="checkbox4">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="cmarks" id="cmarks" class="form-control" value="<?php echo $_SESSION['cmarks'] ?>">
                <label for = "cmarks" >Marks for Correct Answer</label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="inmarks" id="inmarks" class="form-control" value="<?php echo $_SESSION['inmarks'] ?>">
                <label for = "inmarks" >Marks for Incorrect Answer</label>
            </div>
        </div>
    </div>
    <button class="btn btn-default waves-effect waves-light " type="reset"  name="btn-clear" id="btn-clear" >Clear</button>
    <button class="btn btn-primary waves-effect waves-light " type="submit"  name="btn-edit" id="btn-edit" >Save</button>
    <button class="btn btn-primary waves-effect waves-light " type="submit"  name="btn-del" id="btn-del" >Delete</button>
    <a class="btn btn-danger waves-effect waves-light " type="button"  name="btn-home" id="btn-home" href="index.php">Home</a >
    </form>
</body>
</html>
