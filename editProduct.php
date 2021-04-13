<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./forms.css">
        <title>Edit Product</title>
    </head>
    <body>
    <?php 
        include_once('.\config\config.php');
        

    if(isset($_POST['submit'])){
        $id = mysqli_real_escape_string($mysqli, $_POST['product_id']);
        $cat = mysqli_real_escape_string($mysqli, $_POST['product_category']);
        $name = mysqli_real_escape_string($mysqli, $_POST['product_name']);
        $comp = mysqli_real_escape_string($mysqli, $_POST['product_company']);
        $desc = mysqli_real_escape_string($mysqli, $_POST['product_description']);
        $sizes = mysqli_real_escape_string($mysqli, $_POST['product_sizes']);
        $colors = mysqli_real_escape_string($mysqli, $_POST['product_colors']);
        $price = mysqli_real_escape_string($mysqli, $_POST['product_price']);
        $img = mysqli_real_escape_string($mysqli, $_POST['product_img']);

        if(!empty($cat) && !empty($name) && !empty($comp) && !empty($desc) && !empty($colors) && !empty($sizes) && !empty($price) && !empty($img)){
            $sql = "UPDATE product SET 
            product_category = '$cat',
            product_name = '$name',
            product_company = '$comp',
            product_description = '$desc',
            product_sizes = '$sizes',
            product_colors = '$colors',
            product_price = '$price',
            product_img = '$img'
            WHERE product_id = '$id'";
    
            if ($mysqli->query($sql) === TRUE) {
                $mysqli->close();
            header("Location: products.php");
            } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }else{
            echo "Please fill all the fields";
        }
    }


    ?>
    <nav class="navbar">
            <ul class="nav-ul">
                <li><img class="logo" src="./assets/logo.png" alt=""></li>
                <li class='nav-item'><a href="landing.php">HOME</a></li>
                <li class='nav-item'><a href="./about.php">ABOUT US</a></li>
                <li class='nav-item'><a href="./categories.php">SHOP</a></li>
                <li class='nav-item'><a href="./contact.php">CONTACT</a></li>
                <li class='nav-item'><a href="./privacy.php">PRIVACY POLICY</a></li>
                <li class="brand nav-item"><a href="cart.php"><img src="brand.png"></a></li> 
            </ul>
        </nav>
    <div class="main">
		<div class="main-l">
			<div class="header">
            </div>
            <h1>EDIT PRODUCT</h1>
            <?php
            $id = $_GET['id'];
                $sql = "SELECT * FROM product WHERE product_id=$id";
                $result = mysqli_query($mysqli, $sql);
                $res = mysqli_fetch_array($result);

                $cat = $res['product_category'];
                $name = $res['product_name'];
                $company = $res['product_company'];
                $desc = $res['product_name'];
                $sizes = $res['product_sizes'];
                $colors = $res['product_colors'];
                $price = $res['product_price'];
                $img = $res['product_img'];
                $mysqli->close();
            ?>
        <form action="editProduct.php" method="post">
            <input type="text" placeholder="ID" name="product_id" value=<?php echo $id;?>><br>
            <input type="text" placeholder="Category" name="product_category" value=<?php echo $cat;?>><br>
            <input type="text" placeholder="Name" name="product_name" value=<?php echo $name;?>><br>
            <input type="text" placeholder="Company" name="product_company" value=<?php echo $company;?>><br>
            <input type="text" placeholder="Description" name="product_description" value=<?php echo $desc;?>><br>
            <input type="text" placeholder="Sizes" name="product_sizes" value=<?php echo $sizes;?>><br>
            <input type="text" placeholder="Colors" name="product_colors" value=<?php echo $colors;?>><br>
            <input type="text" placeholder="Price" name="product_price" value=<?php echo $price;?>><br>
            <input type="text" placeholder="Image link" name="product_img" value=<?php echo $img;?>><br>
            <input type="submit" name="submit" value="Edit Product">
        </form>    
</div>
    </body>
    
</html>
