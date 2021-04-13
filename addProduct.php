<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./forms.css">
        <title>Add Product</title>
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
            <h1>ADD PRODUCT</h1>
        <form action="addProduct.php" method="post">
            <input type="text" placeholder="Category" name="product_category"><br>
            <input type="text" placeholder="Name" name="product_name"><br>
            <input type="text" placeholder="Company" name="product_company"><br>
            <input type="text" placeholder="Description" name="product_description"><br>
            <input type="text" placeholder="Sizes" name="product_sizes"><br>
            <input type="text" placeholder="Colors" name="product_colors"><br>
            <input type="text" placeholder="Price" name="product_price"><br>
            <input type="text" placeholder="Image link" name="product_img"><br>
            <input type="submit" name="submit" value="Add Product">

</div>    
</div>
    </body>
    <?php 
        include_once('.\config\config.php');

    if(isset($_POST['submit'])){
        $cat = mysqli_real_escape_string($mysqli, $_POST['product_category']);
        $name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
        $comp = mysqli_real_escape_string($mysqli, $_POST['product_company']);
        $desc = mysqli_real_escape_string($mysqli, $_POST['product_description']);
        $sizes = mysqli_real_escape_string($mysqli, $_POST['product_sizes']);
        $colors = mysqli_real_escape_string($mysqli, $_POST['product_colors']);
        $price = mysqli_real_escape_string($mysqli, $_POST['product_price']);
        $img = mysqli_real_escape_string($mysqli, $_POST['product_img']);

        if(!empty($cat) && !empty($name) && !empty($comp) && !empty($desc) && !empty($colors) && !empty($sizes) && !empty($price) && !empty($img)){
            $sql = "INSERT INTO `product`(product_category, product_name, product_company, product_description, product_sizes, product_colors, product_price, product_img) 
            VALUES('$cat', '$name', '$comp', '$desc','$sizes', '$colors', '$price', '$img')";
    
            if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
            } else {
            echo "Error: Something went wrong";
            }
        }else{
            echo "Please fill all the fields";
        }
    }


    ?>
</html>
