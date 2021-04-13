<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./shoes.css">
    </head>
    <body>
    <nav class="navbar">
            <ul class="nav-ul">
                <li><img class="logo" src="./assets/logo.png" alt=""></li>
                <li class='nav-item'><a href="landing.php">HOME</a></li>
                <li class='nav-item del'><a href="./about.php">ABOUT US</a></li>
                <li class='nav-item '><a href="./categories.php">SHOP</a></li>
                <li class='nav-item del'><a href="./contact.php">CONTACT</a></li>
                <li class='nav-item del'><a href="./privacy.php">PRIVACY POLICY</a></li>
                <li class="brand nav-item"><a href="cart.php"><img src="brand.png"></a></li> 
            </ul>
        </nav>
<?php 
    session_start();
    include_once('.\config\config.php');
    if(isset($_SESSION['email'])){
        $email = ($_SESSION['email']);
        $sql = "SELECT A.customer_firstname as n, B.order_id as id, B.customer_id as cID, B.product_ids as pID, B.order_date as d FROM customer A, orders B where A.customer_id = B.customer_id AND A.customer_email = '$email'";
        $result = mysqli_query($mysqli, $sql);
        echo "<div class='p-container'>";
        echo "<h1>Orders</h1>";
        echo "<div class='product-container'>";
        
        while($res = mysqli_fetch_array($result)){
            echo "<a class='product-card' href='#'><div>";
            echo "<h4 class='product-company'>Order ID: " . $res['id'] . "</h4>";
            echo "<h4 class='product-company'>Customer Name: " . $res['n'] . "</h4>";
            echo "<h4 class='product-company'>Date: " . $res['d'] . "</h4>";
            echo "<p class='text name' >Customer ID: " . $res['cID'] . "</p>";
            echo "<p class='text price' >Product Ids: " . $res['pID'] . "</p>";
            echo "</div></a>";
        }
        echo "</div>";
        echo "</div>";
    }else{
        header("Location: signin.php");
    }

?>
    </body>
</html>
