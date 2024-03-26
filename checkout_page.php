<?php

session_start();

//Checks if checkout form is empty and if user accessed the page from the cart
if (!empty($_SESSION['cart'])){

//    Let user in
}
//send user to home page
else{
    header("Location: home_page.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
<!--    css link-->
    <link rel="stylesheet" href="css/checkout_page.css">
</head>
<body>

<!--Navbar Link -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include($IPATH."nav_bar.html")  ?>

    <section class="checkout">
        <div class="checkout-container">
            <h3>CheckOut</h3>
            <div class="checkout-information">
                <form action="config/place_order.php" method="POST">
                    <div class="user-details">
                        <div class="user-input">
                            <span class="details">Full Name</span>
                            <input type="text" placeholder="Enter your name" required name="name">
                        </div>
                        <div class="user-input">
                            <span class="details">Email</span>
                            <input type="email" placeholder="Enter your email" required name="email">
                        </div>
                        <div class="user-input">
                            <span class="details">Phone Number</span>
                            <input type="text" placeholder="Enter your number" required name="phone">
                        </div>
                        <div class="user-input">
                            <span class="details">Shipping Address</span>
                            <input type="text" required name="address">
                        </div>
                        <div class="user-input">
                            <span class="details">City</span>
                            <input type="text" required name="city">
                        </div>
                    </div>

                    <div class = "btn-groups">
                        <p>Total amount: Ksh <?php echo $_SESSION['total'] ?></p>
                        <input type="submit" class="checkout-btn" value="Place Order" name="place_order">
                    </div>

                </form>



            </div>

        </div>
    </section>
</body>
</html>
