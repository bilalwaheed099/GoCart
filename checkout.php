<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="./checkout.css">
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
            session_start();
            include_once('.\config\config.php');
            if(!isset($_SESSION["email"]) || $_SESSION["email"] == ''){
                echo "Sign in first";
                header("Location: signin.php");
            }else{
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM customer WHERE customer_email = '$email'";
                $res = mysqli_query($mysqli, $sql);
                $result = mysqli_fetch_array($res);
            }
            if(isset($_POST['submit'])){
                $ids = mysqli_real_escape_string($mysqli, $_POST['ids']);
                $cID = intval($result['customer_id']);
                $r = ($mysqli->query("SELECT DATE(NOW())"));
                $date = mysqli_fetch_array($r);
                if(strlen($ids)>0){
                    $sql = "INSERT INTO orders (customer_id, order_date, product_ids) Values ('$cID', '$date[0]', '$ids')";
                    if ($mysqli->query($sql) === TRUE) {
                        sleep(2);
                        header("Location: orders.php");
                        } else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                    }
                }
                else{
                    echo "<p>Nothing in the cart.</p>";
                    sleep(2);
                    header("Location: categories.php");
                }
            }
    ?>
    <div class="container">
        <div class="order-items">
            <h3>Order Details</h3>

        </div>
        <div class="pers-info" style="display:flex;flex-direction:column;align-items:center;margin-top:20px;">
            <span class="name"><?php echo $result['customer_firstname']." ".$result['customer_lastname'];?></span><br>
            <p class="email"><?php echo $result['customer_email'];?></p>
            <h3>Your Address:</h3>
            <p class="addr"><?php echo $result['customer_address'];?></p>
            <h4>Payment Option</h4>
            <input type="text" value="Cash on delivery" disabled>
            <h3>Total bill:</h3>
            <p class="bill">Rs. 0</p>
            <form action="checkout.php" method='post'>
                <a href="./landing.php"><button class="checkout" type='submit' name='submit' onClick=checkoutClickHandler()>Place Order</button></a>
                <input class="hid" name='ids' hidden>
            </form>
            
        </div>

    </div>
    <script>
        function checkoutClickHandler(){
            var cartItems=JSON.parse(localStorage.getItem("cart"));
            if(cartItems != null){
                alert("Your order has been placed. Details will be shared with you via email.");
                localStorage.clear();
            }else{
                alert("Nothing in the cart. Add products in your card.");
            }

        }
        function removeClickHandler(id){
            // var id = e.target.parentElement.parentElement.dataset.id;
            console.log(id)
            var ans = confirm("Are you sure?");
            if(ans == true){
                var cartItems = JSON.parse(localStorage.getItem("cart"));
                var deleteItemIndex = cartItems.findIndex(item => item.id===id);
                cartItems.splice(deleteItemIndex,1);
                localStorage.removeItem("cart");
                localStorage.setItem("cart", JSON.stringify(cartItems));
                const delElement = document.querySelector(`.cart-item[data-id="${id}"]`);
                delElement.parentElement.removeChild(delElement);
                document.querySelector('.bill').innerHTML="Rs. 0";
                console.log("removed");
            }
        }
        var cartItems=JSON.parse(localStorage.getItem("cart"));
        var totalAmount = 0;
        window.onload = function(){
            cartItems.forEach(item => {
            totalAmount += parseInt(item.price)*parseInt(item.quantity);
            markup = `<div class="cart-item" data-id=${item.id}>
                                <div class="cart-img">
                                    <img class='item-img' src="./assets/images/${item.img}" alt="">
                                </div>
                                 <div class="middle-one">
                                    <h3 class="company">${item.comp}</h3><br>
                                    <p class="text name">${item.name}</p>
                                    <p class="text desc">${item.desc}</p>
                                    <p class="text price">${item.price}</p>
                                    <button onClick=removeClickHandler(${item.id}) class='rm-cart'>Remove from Cart</button>
                                 </div>
                                 <div class="middle-two">
                                    <p class="text size">Size: ${item.size}</p>
                                    <p class="text desc">Color: ${item.color}</p>
                                 </div>
                                 <div class='right'>
                                    <p class='quantity'>x${item.quantity}</p>
                                    Total Price: <p class='total-price'>Rs. ${item.quantity*item.price}</p>
                                 </div>
                                </div>`;
            document.querySelector('.order-items').insertAdjacentHTML('beforeend', markup); 
            document.querySelector('.bill').innerHTML="Rs. " + totalAmount;
            document.querySelector('.hid').value+=`${item.id},`;
        })
        }
        
    </script>
</body>
</html>