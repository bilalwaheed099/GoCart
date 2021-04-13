<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./forms.css">
    <title>Register</title>
</head>
<body>
<nav class="navbar">
            <ul class="nav-ul">
                <li><img class="logo" src="./assets/logo.png" alt=""></li>
                <li class='nav-item'><a href="landing.php">HOME</a></li>
                <li class='nav-item del'><a href="./about.php">ABOUT US</a></li>
                <li class='nav-item'><a href="./categories.php">SHOP</a></li>
                <li class='nav-item del'><a href="./contact.php">CONTACT</a></li>
                <li class='nav-item del'><a href="./privacy.php">PRIVACY POLICY</a></li>
                <li class="brand nav-item"><a href="cart.php"><img src="brand.png"></a></li> 
            </ul>
        </nav>
<div class="main">
	<div class="main-l">
		<div class="header">
</div>
<h1>Register</h1>
<form class="" action = "registration.php" method = "post">
        <div class="">
            <label for="inputFirstName">First Name</label>
            <input type="text" class="" id="inputFirstName" name = "firstname" placeholder="First Name">
        </div>
        <div class="">
            <label for="inputLastName">Last Name</label>
            <input type="text" class="" id="inputLastName" name = "lastname" placeholder="Last Name">
        </div>
        <div class="">
            <label for="InputEmail1">Email address</label>
            <input type="text" class="" id="InputEmail1" name = "email" placeholder="Enter email">
        </div>
        <div class="">
            <label for="InputPassword1">Choose a Password</label>
            <input type="password" class="" id="InputPassword1" name = "password" placeholder="Password">
        </div>
        <div class="">
            <label for="inputPhone">Mobile Number</label>
            <input type="text" class="" id="inputPhone" name="phone" placeholder="Phone Number">
        </div>
        <div class="">
            <label for="inputAddress">Address</label>
            <textarea cols="30" rows="3" id="inputAddress" name = "address" placeholder="Address"></textarea>
        </div>
        <input type="submit" class="" name="submit" value="Register"></input>
    </form>
</div>

<?php
include_once(".\config\config.php");

if(isset($_POST['submit']) && isset($_POST['email'])){
    $first_name = mysqli_real_escape_string($mysqli, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($mysqli, $_POST['lastname']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);
    $password = md5($pass);

    if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone) && !empty($address) && !empty($password)){
        $sql = "INSERT INTO `customer`(customer_firstname, customer_lastname, customer_email, customer_phone, customer_address, customer_password) 
        VALUES('$first_name', '$last_name', '$email', '$phone', '$address', '$password')";

        if ($mysqli->query($sql) === TRUE) {
        echo "New record created successfully. <a href='./signin.php'><button>Go to Sign in</button></a>";
        } else {
        echo "Email already taken!";
        }
    }else{
        echo "Please fill all the fields";
    }
}



?>
  
</body>
</html>