<!DOCTYPE html>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./shoes.css">
        <title>Shoes</title>
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
    include_once('.\config\config.php');

    $sql = "SELECT * FROM product where product_category = 'shoes'";

    $result = mysqli_query($mysqli, $sql);

    echo "<div class='p-container'>";
    echo "<h1>Shoes</h1>";
    echo "<div class='product-container'>";
    
    while($res = mysqli_fetch_array($result)){
        $name = str_replace(" ","-",$res['product_name']);
        $desc = str_replace(" ","-",$res['product_description']);
        echo "<a class='product-card' href='./productDetails.php?id=$res[product_id]'><div>";
        echo "<img class='product-img' data-img=$res[product_img]  src='./assets/images/" . $res["product_img"] . "'>";
        echo "<h2 class='product-company' data-company=$res[product_company]>" . $res['product_company'] . "</h2>";
        echo "<p class='text name' data-name=$name>" . $res['product_name'] . "</p>";
        echo "<p class='text desc' data-desc=$desc>" . $res['product_description'] . "</p>";
        echo "<p class='text price' data-price=$res[product_price]>Rs. " . $res['product_price'] . "</p>";
        // echo "<button data-id=$res[product_id] class='cart-btn'>Add to Cart</button>";
        echo "</div></a>";
    }
    echo "</div>";
    echo "</div>";
?>

    <script>
        var btns = document.querySelectorAll('.cart-btn')
        btns.forEach(btn => btn.addEventListener('click', function(e){
            var arr= [];
            var cartItems = JSON.parse(localStorage.getItem("cart"));
            if(cartItems !=undefined){
                cartItems.forEach(it => {
                    arr.push(it);
                })
            }
            console.log(cartItems)
            // console.log(cartArr);
            var obj = {
                img: e.target.parentElement.querySelector('.product-img').dataset.img,
                comp: e.target.parentElement.querySelector('.product-company').dataset.company,
                name: e.target.parentElement.querySelector('.name').dataset.name.replaceAll("-", " "),
                desc: e.target.parentElement.querySelector('.desc').dataset.desc.replaceAll("-", " "),
                price: e.target.parentElement.querySelector('.price').dataset.price,
                id: e.target.parentElement.querySelector('.cart-btn').dataset.id,
            }
            console.log(obj.desc)
            arr.push(obj)
            localStorage.removeItem("cart")
            localStorage.setItem("cart", JSON.stringify(arr))
            alert("Item added to cart")
        }))
        
    </script>
    </body>
</html>
