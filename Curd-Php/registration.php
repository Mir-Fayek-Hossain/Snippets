<?php
session_start();
$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'userregistration');
if(isset($_POST['user'])){
    $name=trim($_POST['user']);
    $pass=trim($_POST['password']);
    $cpass=$_POST['cpassword'];
    $error="";
    if($pass!=$cpass){
        $error="**Password did not matched**";
    }
    else{
        $error="";
        $s="select * from usertable where name='$name'";
        $result=mysqli_query($con,$s);
        $num=mysqli_num_rows($result);
        if($num==1){
            $error="**User already taken!**";
        }else{
            $pass=password_hash(trim($_POST['password']),PASSWORD_DEFAULT);
            $reg="insert into usertable (name ,password )values('$name','$pass')";
            mysqli_query($con,$reg);
            $_SESSION['reg_check']="success";
            header('location:login.php');
        }
    }
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
    background-color: #829F97;
}

.pas1 {
    margin-top: -30px;
}
</style>

<body data-aos="zoom-out">
    <div class="card">
        <img data-aos="fade-right" data-aos-duration="2000" class="card__image"
            src="https://i.pinimg.com/564x/5a/83/5a/5a835afd674b1ab44b8771f90ce87aab.jpg" alt="">
        <div class="card__content c2">
            <h3 data-aos="flip-up" data-aos-duration="2000" class="card__head">VOGUE</h3>
            <div class="card__wrap">
                <h4 data-aos="zoom-in" data-aos-duration="2000" class="card__title">Discover the
                    <span class="card__clr">latest trend now</span>
                </h4>
                <form class="card__form" method="POST">
                    <input class="card__input" type="text" name="user" placeholder="Username" required>
                    <span class="card__icon ">
                        <svg width="26" height="40" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <input class="card__input" type="password" name="password" placeholder="Password" required>
                    <span class="card__icon1 pas1">
                        <svg width="26" height="40" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input data-aos="zoom-in" data-aos-duration="2000" class="card__input" type="password"
                        name="cpassword" placeholder="Confirm Password" required>

                    <div class="warning">
                        <?php
                            if(isset($_POST['user'])){
                            echo $error;
                            }
                        ?>
                    </div>
                    <button data-aos="fade-left" data-aos-duration="2000" type=" submit" class="card__btn">Sign
                        up</button>
                </form>
            </div>
            <div class="card__footer"> <span>
                    <h2>Already have an account?</h2>
                    <h3>
                        Sign in now to get the best deals!
                    </h3>
                </span>
                <a href="login.php"> <button class="card__signup">
                        <h2>Sign in</h2>
                    </button>
                </a>
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