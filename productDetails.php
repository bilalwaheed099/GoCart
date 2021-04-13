<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./productDetails.css">
    <title>Details</title>
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
        <div style="clear: both"></div>

<?php 
    include_once('.\config\config.php');

    $prod_id = $_GET['id'];
    $sql = "SELECT * FROM product where product_id = $prod_id";
    $result = mysqli_query($mysqli, $sql);
    $res = mysqli_fetch_array($result);
    $name = str_replace("-"," ",$res['product_name']);
    $desc = str_replace("-"," ",$res['product_description']);
    $sizes = explode(",", $res['product_sizes']);
    $colors = explode(",", $res['product_colors']);
    
?>
<div class="body">
    <div class="container">
        <img class='product-img' data-img='<?php echo $res['product_img'];?>' src="./assets/images/<?php echo $res['product_img']?>" alt="">
        <div class="middle">
            <h2 class="company"><?php echo $res['product_company'];?></h2>
            <h2 class="name"><?php echo $name;?></h2>
            <p class="desc"><?php echo $desc;?></p>
            Rs. <h3 class="price"><?php echo $res['product_price'];?></h3>
            <button data-id=<?php echo $res['product_id'];?> class='cart-btn btn'>Add to Cart</button>
            <p class="err"></p>

        </div>
        <div class="right">
        <form action="productDetails.php" method="post">
                <label for="quantity">Quantity</label>
                <input class="quantity" type="number" name="quantity" min=0>
                <?php
                if (sizeof($colors) > 0){
                    echo "<h3>Select a color:</h3>";
                    foreach($colors as $color){
                        echo "<div class='color-option'>";
                        echo "<input type='radio' name='color' id='$color' value='$color'>";
                        echo "<label for=\"$color\"><div class='color' style=\"background: $color\"></div></label>";
                        echo "</div>";
                    }
                }
                    if(sizeof($sizes) > 0) {
                        echo "<h3>Select a size:</h3>";
                        foreach($sizes as $size){
                            echo "<div class='color-option'>";
                            echo "<input type='radio' name='size' id='$size' value='$size'>";
                            echo "<label for=\"$size\"><div class='size'>$size</div></label>";
                            echo "</div>";
                        }
                    }
                ?>
            </form>

        </div>
    </div>
    </div>


    <script>
        var btns = document.querySelectorAll('.cart-btn');
        btns.forEach(btn => btn.addEventListener('click', function(e){
            var clrEl = document.querySelector('input[name="color"]:checked');
            var color;
            if(clrEl != null){
                color = clrEl.value;
            }
            var sizeEl = document.querySelector('input[name="size"]:checked');
            var size;
            if(sizeEl != null){
                size = sizeEl.value;
            }
            var quantity = document.querySelector('.quantity').value;
            if(clrEl != null && quantity > 0){
                var arr= [];
                var cartItems = JSON.parse(localStorage.getItem("cart"));
                if(cartItems !=undefined){
                    cartItems.forEach(it => {
                        arr.push(it);
                    })
                }
                var obj = {
                img: e.target.parentElement.parentElement.querySelector('.product-img').dataset.img,
                comp: e.target.parentElement.querySelector('.company').innerHTML,
                name: e.target.parentElement.querySelector('.name').innerHTML.replaceAll("-", " "),
                desc: e.target.parentElement.querySelector('.desc').innerHTML.replaceAll("-", " "),
                price: e.target.parentElement.querySelector('.price').innerHTML,
                id: e.target.parentElement.querySelector('.cart-btn').dataset.id,
                quantity: quantity,
                color: color,
                size: size
                }
                console.log(obj.desc)
                arr.push(obj)
                localStorage.removeItem("cart")
                localStorage.setItem("cart", JSON.stringify(arr))
                alert("Item added to cart")
            }else{
                document.querySelector('.err').textContent = "Please select size, color and quantity."
            }

        }))
    </script>
    
</body>
</html>