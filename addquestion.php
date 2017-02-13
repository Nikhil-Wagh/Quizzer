<?php
include('session.php');
//echo $_SESSION['qbid'];
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
    
     <script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
			
            $("#btn-save").click(function(event){
               $.post( 
                  "add.php",
                  {
            		  quest:$('#quest').val(),
            		  opt1:$('#opt1').val(),
                      opt2:$('#opt2').val(),
                      opt3:$('#opt3').val(),
                      opt4:$('#opt4').val(),
                      ans:$('input[type="radio"]:checked').val(),
                      cmarks:$('#cmarks').val(),
                      inmarks:$('#inmarks').val(),
        		},
                  function(data) {
                       $("#stage").html(data); 
                  }
               );	
            });
         });
      </script>
    
<body>
    <form id="statement">
        <div id="stage"> </div>
    <div class="md-form">
        <textarea type="text" name="quest" id="quest" class="md-textarea"  data-toggle="tooltip" data-placement="bottom" title="Enter your Question in this textarea." ></textarea>
        <label for="question">Enter your Question</label>
        
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="opt1" id="opt1" class="form-control" >
                <label for = "opt1" >Option 1</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox1" value="1">
                        <label for="checkbox1">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="opt2" id="opt2" class="form-control">
                <label for = "opt2" >Option 2</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox2" value="2">
                        <label for="checkbox2">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="opt3" id="opt3" class="form-control">
                <label for = "opt3" >Option 3</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox3" value="3">
                        <label for="checkbox3">Correct Answer</label>
                      
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="opt4" id="opt4" class="form-control">
                <label for = "opt4" >Option 4</label>
                    <fieldset class="form-group">
                        <input type="radio" class="radio" name ="radiobutton" id="checkbox4" value="4">
                        <label for="checkbox4">Correct Answer</label>
                        
                    </fieldset>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="cmarks" id="cmarks" class="form-control">
                <label for = "cmarks" >Marks for Correct Answer</label>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="md-form">
                <input type = "text" name="inmarks" id="inmarks" class="form-control">
                <label for = "inmarks" >Marks for Incorrect Answer</label>
            </div>
        </div>
    </div>
    <button class="btn btn-default waves-effect waves-light " type="reset"  name="btn-clear" id="btn-clear" >CLEAR</button>
    <button class="btn btn-primary waves-effect waves-light " type="button"  name="btn-save" id="btn-save" >Save</button>
    <a class="btn btn-danger waves-effect waves-light " type="button"  name="btn-home" id="btn-home" href="index.php">Home</a >
    </form>
</body>
</html>