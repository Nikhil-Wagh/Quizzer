<?php
include("session.php");
$sql="SELECT * FROM quizzer.".$_SESSION['examid']." ORDER BY score DESC";
$result=mysqli_query($conn,$sql);
//echo $_SESSION['ename'];
if(mysqli_num_rows($result)>0)
{
    echo "<h1 class='display-3'>Leader Board</h1>";
    echo "<table>";
    echo " <tr>
            <th>Rank</th>
            <th>Handle</th>
            <th>Score</th>
            <th>Attempted</th>
        </tr>";
    $rank=1;
    while($row=mysqli_fetch_array($result))
    {
        echo "<tr>
                <td>{$rank}</td>
                <td>{$row['handle']}</td>
                <td>{$row['score']}</td>
                <td>{$row['attempted']}</td>
            </tr>";
        $rank++;
    }
    echo "</table>";
}
else 
{
    echo "Error retrieving values from database";
}
?>
<!DOCTYPE html>
<html lang ="en">
<head>
<title>Leader Board</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/mdb.min.css">
</head>
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
        display: table;
    }
    td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}
    table{
        width: auto;
        margin: auto;
        margin-top: 20px;
    }
    .display-3{
        text-align: center;
    }
    </style>
    <body>
       <a class='btn btn-primary waves-effect waves-light' type='button' name='btn-home' href='index.php'>Home</a>;
    </body>
</html>

    