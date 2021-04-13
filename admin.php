<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Contact</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/">
	<link rel="stylesheet" href="forms.css">
</head>
<body>

<nav class="navbar">
            <ul class="nav-ul">
                <li><img class="logo" src="./assets/logo.png" alt=""></li>
                <li class='nav-item'><a href="landing.php">HOME</a></li>
                <li class='nav-item'><a href="./about.php">ABOUT US</a></li>
                <li class='nav-item'><a href="./categories.php">SHOP</a></li>
                <li class='nav-item'><a href="./contact.php">CONTACT</a></li>
                <li class='nav-item'><a href="./privacy.php">PRIVACY POLICY</a></li>
                <li class="brand nav-item"><a href="cart.php"><img src="brand.png"></a></li> 
                <div style="clear:both"></div>
            </ul>
        </nav>
        <div class="main" style="padding: 50px;">
    <?php
    session_start();
        include_once('.\config\config.php');
        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
            if($email=='admin@gocart.com'){
                echo "<a href='products.php'><button>View Products</button></a>";
            }
        }else{
            echo "<p>Sign in as admin to view the panel.</p>";
            echo "<a href='signin.php'><button>Go to Sign in</button></a>";
        }
    ?>



</div>
	
</body>
</html>
