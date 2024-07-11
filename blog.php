<?php
    include "Components/_navbar.php";
    
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header("location: login.php");
        exit;
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "blog";
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        die("Connection is not established" . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_post'])) {
        if (isset($_POST['post_id'])) {
            $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
            $delete_query = "DELETE FROM `userposts` WHERE `id` = '$post_id'";
            if (mysqli_query($conn, $delete_query)) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } 
        mysqli_close($conn);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['user_posts'])){
            $userpost = $_POST['user_posts'];
            $postedmail = $_SESSION['mail'];
            $insert_query = "INSERT INTO `userposts` (`user_posts`,`mail`) VALUES ('$userpost','$postedmail')";
            $result = mysqli_query($conn, $insert_query);
            if($result){
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo '<script>alert("Failed to insert post.");</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .postip {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 0;
            background-color: black;
        }
        .postip form {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        input[type="text"] {
            width: 700px;
            height: 30px;
            text-align: center;
            font-size: 20px;
        }
        input[type="submit"] {
            width: 90px;
            height: 35px;
            text-align: center;
        }
        .blogscontainer {
            display: flex;
            justify-content: center;
            width: 100%;
            align-items: center;
        }
        .blogscontainer .box {
            width:900px;
            display: flex;
            flex-direction: column;
            justify-content:center;
            align-items:center;
            border:7px solid;
            border-radius:15px;
            margin: 10px;
        }
        .blogscontainer .box button {
            width: 90px;
            height: 35px;
            text-align: center;
            border-radius:15px;
        }
        .blogscontainer .box .uit{
            border:2px solid;
            background-color:black;
            color:white;
            width: 900px;
            display:flex;
            justify-content:space-between;
            border-radius:15px;
            align-items:center;
        }

    </style>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "blog";
        $conn = mysqli_connect($servername, $username, $password, $database);
        if(!$conn){
            die("Connection is not established" . mysqli_connect_error());
        } else {
            $query = "SELECT * FROM `userposts`";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $postedmail = $row['mail'];
                    echo '<div class="blogscontainer">
                            <div class="box">
                                <div class="uit">
                                    <span><strong>User:</strong> '.$postedmail.'</span>
                                    <p>'.date('d-m-y').'</p>
                                    <form method="post" action="'.$_SERVER['PHP_SELF'].'">
                                        <input type="hidden" name="post_id" value="'.$row['id'].'">
                                        <button type="submit" name="delete_post">delete</button>
                                    </form>
                                </div>
                                <p>'.$row['user_posts'].'</p>
                            </div>
                        </div>';
                }
            }
        }
    ?>
    <div class="postip">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input type="text" name="user_posts" id="user_posts" placeholder="Enter your post">
            <input type="submit" id="submit" value="Post">
        </form>
    </div>

<script>
    $(document).ready(function() {
        $("#submit").submit(function() {    
            var user_posts = $("#user_posts").val();
            if(user_posts == '') {
                alert("Please post something    .");
                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo $_SERVER['PHP_SELF'];?>",
                data: {
                    user_posts: user_posts
                },
                cache: false,
                success: function(response) {
                    alert(user_posts); 
                    location.reload(); 
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    });

    $(document).ready(function() {
        var response = '';
        $.ajax({
            type: "GET",
            url: "<?php echo $_SERVER['PHP_SELF'];?>",
            async: false,
            success: function(text) {
                response = text;
            }
        });

        alert(response);
    });
    
    $(document).ready(function() {
        $(".delete-post").click(function(e) {
            e.preventDefault();
            var postId = $(this).data('post-id');

            $.ajax({
                type: "POST",
                url: "<?php echo $_SERVER['PHP_SELF'];?>",
                data: {
                    delete_post: true,
                    post_id: postId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert('Post deleted successfully.');
                        location.reload(); // Refresh page after successful deletion
                    } else {
                        alert('Failed to delete post.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert('Error deleting post.');
                }
            });
        });
    });


</script>
</body>
</html>
