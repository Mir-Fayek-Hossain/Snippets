<?php
session_start();
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'userregistration');
if(isset($_POST['user'])){
$error="";
$uname=trim($_POST['user']);
$name=$_SESSION['username']; 
$pass=trim($_POST['password']);
$s="select * from usertable where name='$uname'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($uname==$name){
	 $error="**You have entered the same username that you have.**";
}else if($num==1){
	 $error="**Username isn't available.**";
	}
	 else{
$s="select * from usertable where name='$name'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);
if($num==1){
    $row = mysqli_fetch_assoc($result);
    $pass_hash=$row['password'];
    $a=password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
    if(password_verify($pass,$pass_hash)){
		 $reg="update usertable
SET name = '$uname'
WHERE name='$name'"; 
            mysqli_query($con,$reg);
    $_SESSION['update']="success";
    $_SESSION['username']=$uname;
    header('location:home.php');
	}
	else{
		 $error="**Password incorrect**";
	}
}else{
     $error="**Password did not matched**";
} }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,400i,700">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body {
    background-color: #E5AE94;
}

.pas1 {
    margin-top: -21px;
}
</style>

<body data-aos="zoom-in">
    <div class="card">

        <div class="card__content c1">
            <h3 data-aos="flip-up" data-aos-duration="2000" class="card__head">VOGUE</h3>
            <div class="card__wrap">
                <h5 data-aos="zoom-in" class="card__title">Update your username
                </h5>
                <form class="card__form" method="POST">
                    <input class="card__input" type="text" name="user" placeholder="Username" required>
                    <span class="card__icon">
                        <svg width="26" height="40" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input class="card__input " type="password" name="password" placeholder="Password" required>
                    <span class="card__icon1 pas1">
                        <svg width="26" height="40" viewBox="0 8 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <div class="warning">
                        <?php
                            if(isset($_POST['user'])){
                            echo $error ;
                            }
                        ?>
                    </div>
                    <button data-aos="fade-right" data-aos-duration="2000" type="submit"
                        class="card__btn">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    AOS.init({
        duration: 1200,
    })
    </script>
</body>

</html>