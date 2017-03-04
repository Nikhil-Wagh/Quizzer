<?php
    include("session.php");
    //error_reporting(0);
    //echo $_SESSION['questions'][$_SESSION['qno']];
    if(!isset($_SESSION['handle']))
    {
        ?>
        <script>alert("You need to Login to Continue")</script>
        <?php
        header("Location: SignUp.php");
    }
    $_SESSION['min'] = 60;
    $_SESSION['sec'] = 60;
    /*echo "question number".$_SESSION['qno'];
    echo "<br>Total ".$_SESSION['tqno'];
    echo "<br>qbid ".$_SESSION['qbid'];
    echo "<br>";*/
    $_SESSION['qno'] = ($_SESSION['qno'])%$_SESSION['tqno'];
    //$_SESSION['qno']++;
    
    $sqlq="SELECT * FROM id593597_questionbank.".$_SESSION['qbid']." WHERE qno = ".$_SESSION['questions'][$_SESSION['qno']];
    //echo $sqlq;
    $result = mysqli_query($conn2,$sqlq);
    global $row;$sans=0;
    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_array($result))
        {
            $_SESSION['question']=$row['question'];
            $_SESSION['a']=$row['a'];
            $_SESSION['b']=$row['b'];
            $_SESSION['c']=$row['c'];
            $_SESSION['d']=$row['d'];
            //$_SESSION['correct']=$row['correct'];
        }
    }
    else
    {
        ?>
        <script>alert("Error displaying questions");</script>
        <?php
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
 <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/sudo-systems/jquery-sudo-notify/master/dist/style/jquery.sudo-notify.min.css" />   
<script type="text/javascript" src="https://cdn.rawgit.com/sudo-systems/jquery-sudo-notify/master/dist/jquery.sudo-notify.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
    <style>
        .container{
            padding: 10px;
            margin: auto;
            display: block;
        }
        .btn-toolbar{
            margin: auto;
            float: right;            
        }
        body {
            padding: 20px;
        }
        .form-control {
            min-height: 100px;
            max-height: 900px;
            height: auto;
        }
        .ver
        {
            float: right;
            width: 96.5%;
        }
         .alert {
            padding: 20px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            margin-top: 0px;
            position: relative;
        }

        /* The close button */
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
        }

        .closebtn:hover {
            color: black;
        }
       

        #clockdiv{
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdiv > div{
            padding: 10px;
            border-radius: 3px;
            background: #3399ff;
            display: inline-block;
        }

        #clockdiv div > span{
            padding: 15px;
            border-radius: 3px;
            background: #0000ff;
            display: inline-block;
        }

        .smalltext{
            padding-top: 5px;
            font-size: 16px;
        }    
    </style>
    <script type="text/javascript">
        function expandtext(expand) {
            while (expand.rows > 1 && expand.scrollHeight < expand.offsetHeight) {
                console.log("display all rows!") >
            }
        }
    </script>
    <script>
        $(function(){
        $('input[type="radio"]').click(function(){
        if ($(this).is(':checked'))
        {
            if(this.value == 1)
            {
                $('#a').show();
                $('#b').hide();
                $('#c').hide();
                $('#d').hide();
            }    
            else if(this.value == 2)
            {
                $('#b').show();
                $('#a').hide();
                $('#c').hide();
                $('#d').hide();
            }
            else if(this.value == 3)
            {
                $('#c').show();
                $('#a').hide();
                $('#b').hide();
                $('#d').hide();
            }
           else if(this.value == 4)
            {
                $('#d').show();
                $('#a').hide();
                $('#c').hide();
                $('#b').hide();
            }
        }
      });
    });
    btn1 = document.getElementById('btn-clear');
    function foo(){
        //alert("clear");
        $('#d').hide();
        $('#a').hide();
        $('#c').hide();
        $('#b').hide();
    }
        btn1.onclick = foo;
    </script>
    <script>
        // Set the date we're counting down to
        var x = setInterval(function() {

            // Get todays date and time
            var nowmin = new Date().getMinutes();
            var nowsec = new Date().getSeconds();

            var endmin = <?php echo $_SESSION['min'] ?>;
            var endsec = <?php echo $_SESSION['sec'] ?>;

            document.getElementById("min").innerHTML =(endmin-nowmin)  ; 
            document.getElementById("sec").innerHTML =(endsec-nowsec)  ; 
            // If the count down is over, write some text 
            if ((endmin-nowmin) < 0&&(endsec-nowsec)<0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
</head>
<body>
 
    <div class="container">
       <div class="pull-right" style="text-align:center">
            <h3 >Countdown Clock</h3>
            <div  id="clockdiv">
                <div>
                    <span class="minutes" id="min"></span>
                    <div class="smalltext">Minutes</div>
                </div>
                <div>
                    <span class="seconds" id ="sec"></span>
                    <div class="smalltext">Seconds</div>
                </div>
            </div>
        </div>
        <h1 class="display-4"><small class="text-muted">Hello </small><?php echo $_SESSION['handle']?></h1>
        <p class="lead" >Your score: <?php echo $_SESSION['score']?></p>
        <form id="statement" action="score.php" method="post">
            <div id="stage"> </div>
            <div class="form-group">
                <h4> Question <?php echo $_SESSION['qno']+1; ?></h4>  
                <textarea type="text" name="quest" id="quest" rows="8" class="form-control" rows="4" style="border: none;" readonly onkeydown="expandtext(this);"><?php echo $_SESSION['question']; ?></textarea>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <!-- <textarea type = "text" name="opt1" id="opt1" class="md-textarea" ></textarea>
                    <label for = "opt1" >Option A</label>-->
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox1" value="1">
                        <label for="checkbox1"></label>
                        <pre class="ver"><?php echo $_SESSION['a']; ?></pre>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox2" value="2">
                        <label for="checkbox2"></label>
                        <pre class="ver"><?php echo $_SESSION['b']; ?></pre>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox3" value="3">
                        <label for="checkbox3"></label>
                        <pre class="ver"><?php echo $_SESSION['c']; ?></pre>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox4" value="4">
                        <label for="checkbox4"></label>
                        <pre class="ver"><?php echo $_SESSION['d']; ?></pre>
                    </fieldset>
                </div>
            </div>
            <div id='a' class="alert" style='display:none;' onclick="foo();">
        <strong>
            <i>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> Option A is selected
            </i>
        </strong>
    </div>
    <div id='b' class="alert" style='display:none' onclick="foo();">
        <strong>
            <i>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> Option B is selected
            </i>
        </strong>
    </div>
    <div id='c' class="alert" style='display:none' onclick="foo();">
        <strong>
            <i>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> Option C is selected
            </i>
        </strong>
    </div>
    <div id='d' class="alert" style='display:none' onclick="foo();">
        <strong>
            <i>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> Option D is selected
            </i>
        </strong>
    </div>
            <!--<div id='a' style='display:none'><strong><i>Option A is seleted</i></strong></div>
            <div id='b' style='display:none'><strong><i>Option B is seleted</i></strong></div>
            <div id='c' style='display:none'><strong><i>Option C is seleted</i></strong></div>
            <div id='d' style='display:none'><strong><i>Option D is seleted</i></strong></div>-->
            <button class="btn btn-default" type="reset"  name="btn-clear" id="btn-clear" onclick = "foo();">CLEAR</button>
            <?php 
            if($_SESSION['tqno']>($_SESSION['qno']+1))
            {
                ?>
                <button class="btn btn-dark-green" type="submit"  name="btn-next" id="btn-next" >NEXT</button>
                <?php
            }
            ?>
            <button class="btn btn-danger" type="submit"  name="btn-submit" id="btn-submit" >SUBMIT</button>
        </form>
    </div>
</body>
</html>
