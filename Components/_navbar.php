<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <style>
        body{
            margin:0;
            padding:0;
        }
        #navbar{
            top:0;
            position:sticky;
            background-color:black;
            color:white;
            display:flex;
            justify-content:center;
        }
        #navbar .navlist{
            display:flex;
            justify-content:space-evenly;
            width:700px;
            /* border:2px solid; */
        }
        #navbar .navlist li{
            list-style:none;
        }
        #navbar .navlist li a{
            text-decoration:none;
            color:white;
            font-size:25px;
            font-weight:bold;
        }
        #navbar .navlist li a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>
    <nav id=navbar>
        <ul class="navlist">
            <li><a href="http://localhost/Ajax/home.php">Home</a></li>
            <li><a href="http://localhost/Ajax/blog.php">Blog</a></li>
            <li><a href="http://localhost/Ajax/login.php">Login</a></li>
            <li><a href="http://localhost/Ajax/signup.php">Signup</a></li>
            <li><a href="http://localhost/Ajax/logout.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>