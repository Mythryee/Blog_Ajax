<?php
    include "Components/_navbar.php";
?>

<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .homecontainer::before{
            background : url('course.jpg')no-repeat center center/cover;
            content:"";
            top:0;
            bottom:0;
            position:absolute;
            height:100%;
            width:100%;
            opacity:0.9;
            z-index:-1;
        }
        .homecontainer{
            display:flex;
            justify-content:center;
        }
        span{
            margin:5px;
            color:white;
            font-size:40px;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="homecontainer">
        <span>Welcome  <?php echo $_SESSION['mail'] ?></span>
    </div>
</body>
</html>