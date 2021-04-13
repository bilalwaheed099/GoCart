<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forms.css">

    <title>Sign in</title>
</head>
<body>
<nav class="navbar">
            <ul class="nav-ul">
                <li><img class="logo" src="./assets/logo.png" alt=""></li>
                <li class='nav-item'><a href="landing.php">HOME</a></li>
                <li class='nav-item del'><a href="./about.php">ABOUT US</a></li>
                <li class='nav-item'><a href="./categories.php">SHOP</a></li>
                <li class='nav-item del'><a href="./contact.php">CONTACT</a></li>
                <li class='nav-item del' ><a href="./privacy.php">PRIVACY POLICY</a></li>
                <li class="brand nav-item"><a href="cart.php"><img src="brand.png"></a></li> 
            </ul>
        </nav>
        <div class="main">
		<div class="main-l">
			<div class="header">
            </div>
            <h1>Sign in</h1>
<form class="" action = "signin.php" method = "post">
        <p style='color: red'><i>You need to sign in before proceeding!</i></p>
        <div class="">
            <label for="InputEmail1">Email address</label>
            <input type="text" class="" id="InputEmail1" name = "email" placeholder="Enter email">
        </div>
        <div class="">
            <label for="InputPassword1">Password</label><br>
            <input type="password" class="" id="InputPassword1" name = "password" placeholder="Password">
        </div>
        <input type="submit" class="" name="submit" value="Sign In">
    </form>
    <p>New here?</p>
        <a href="./registration"><button class="btn">Register</button></a>
</div>
<?php
session_start();
include_once(".\config\config.php");

if(isset($_POST['submit']) && isset($_POST['email'])){

    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password = md5($pass);
    $_SESSION["email"] = $email;

    if(!empty($email) && !empty($password)){
        $sql = "SELECT * FROM customer WHERE customer_email = '$email' AND customer_password = '$password';";
        $res = $mysqli->query($sql);
        $result = mysqli_fetch_array($res);
        if($result['customer_email']==$email && $result['customer_password']==$password){
            if($email=='admin@gocart.com'){
                header("Location: admin.php");
            }else{
                header("Location: checkout.php");
            }
        }    
        else {
        echo "Error: Incorrect email or password. Please try again.";
        }
    }else{
        echo "Please fill all the fields";
    }
}
    $mysqli->close();
?>
  
</body>
</html>