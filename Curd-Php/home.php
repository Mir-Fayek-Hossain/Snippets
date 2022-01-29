<?php
session_start();


if(empty($_SESSION['update'])){
}else{
    echo '<script>alert("Update successful");</script>'; 
    $_SESSION['update']="";
}

if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <a href="login.php">logout</a>
    <a href="update.php">Update</a>
    <a href="delete.php">Delete</a>

    <h2>Welcome <?php echo $_SESSION['username'];?></h2>
</body>

</html>