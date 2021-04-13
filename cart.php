<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./cart.css">
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
        <div class="container">
        <div class="cart-container">
        <!-- <div class="cart-item" data-id=${item.id}>
            <div class="cart-img">
                <img src="./assets/images/${item.img}" alt="">
            </div>
            <div class="right">
                <h3 class="company">Company</h3>
                <p class="text name">name</p>
                <p class="text desc">This is the description</p>
                <p class="text price">Rs. 10000</p>
                <button onClick=removeClickHandler(${item.id})>Remove from Cart</button>
            </div>
        </div> -->
    </div>
    <a href="./checkout.php"><button class='checkout-btn'>CHECKOUT</button></a>

        </div>



    <script>
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
                console.log("removed");
            }
        }

        var cartItems=JSON.parse(localStorage.getItem("cart"));
        window.onload = function(){
            if(cartItems != undefined){
            cartItems.forEach(item => {
                console.log(item.id)
                const markup = `<div class="cart-item" data-id=${item.id}>
                                <div class="cart-img">
                                    <img src="./assets/images/${item.img}" alt="">
                                </div>
                                 <div class="right">
                                    <h3 class="company">${item.comp}</h3>
                                    <p class="text name">${item.name}</p>
                                    <p class="text desc">${item.desc}</p>
                                    <p class="text price">Rs. ${item.price}</p>
                                    <button class='rm-btn' onClick=removeClickHandler(${item.id})>Remove from Cart</button>
                                 </div>
                                </div>`;
                document.querySelector('.cart-container').insertAdjacentHTML('beforeend', markup);
                })
            };
        };
    </script>
</body>

</html>
