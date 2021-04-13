<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./products.css">
    <title>Products</title>
</head>
    <body>
    <?php
        //including the database connection file
        include_once(".\config\config.php");

        $sql = "SELECT * from product";
        $result = mysqli_query($mysqli, $sql);
    ?>
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
            <div style="clear:both"></div>
        </nav>

        <div style="width: 100%" class="table-cont">
        <table style="border: 1px solid black; border-collapse: collapse;">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Company</th>
                <th>Description</th>
                <th>Sizes</th>
                <th>Colors</th>
                <th>Price</th>
                <th>Image</th>
                <th>Update</th>
            </tr>
            <?php 
                while($res = mysqli_fetch_array($result) ){ 
                    echo "<tr>";
                    echo "<td>".$res['product_id']."</td>";
                    echo "<td>".$res['product_category']."</td>";
                    echo "<td>". $res['product_name'] ."</td>";
                    echo "<td>". $res['product_company'] ."</td>";
                    echo "<td>". $res['product_description']."</td>";
                    echo "<td>". $res['product_sizes']."</td>";
                    echo "<td>". $res['product_colors']."</td>";
                    echo "<td>". $res['product_price']."</td>";
                    echo "<td>". $res['product_img']."</td>";
                    echo "<td><div><a href=\"editProduct.php?id=$res[product_id]\">Edit<a> | <a href='delProduct.php?id=$res[product_id]' onclick=\"return confirm('Are you sure you want to delete? This cannot be undone!')\">Delete<a></div></td>";
                    echo "</tr>";
                }
                echo "</table><br>";
                echo "<div><a href=\"addProduct.php\"><button>Add Product</button></a></div>";
            ?>
        </div>
    </body>
</html>