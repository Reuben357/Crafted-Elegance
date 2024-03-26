<?php
session_start();

//Checks if the user came to the carts page through the form or not
if(isset($_POST['add_to_cart'])){ //Check if the user clicked on add-to-cart btn or not
    //Check the session
    if(isset($_SESSION['cart'])){
        //Checks if the user has already added smth to the cart before then just add more to the cart

        $products_array_ids =array_column($_SESSION['cart'], "product_id"); //Returns an array with all products ids

        //If stmt to check, if product has already been added to cart or not
        if(!in_array($_POST['product_id'], $products_array_ids)){ //if not add it to cart

            $product_id = $_POST['product_id'];

                $product_array = array(
                        'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
               'product_price' => $_POST['product_price'],
               'product_image' => $_POST['product_image'],
               'product_quantity' => $_POST['product_quantity'],
               );

	       $_SESSION['cart'][$product_id] = $product_array;



	//product has already been added
	}else{

            echo '<script>alert("Product already added")</script>';

	}
        // If this is the first product then add it for the first time
    }else{

        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity']; //Add these parameters to an array

        $product_array = array(
//These are the keys in the value array
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );

        //Add the above array to a session
        $_SESSION['cart']['product_id'] = $product_array;

        //Each array added to the cart must have a unique id hence the structure(,
        // [ 2=>[] which is in a key value pair structure where the key is 2,
        //and the value is an the array of product above ]])
    }

//    Calc Total
    calcTotalCart();

    //Code below remove smth from the cart
}elseif(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

//    When smth removed from cart, recalculate the total
    calcTotalCart();

}elseif (isset($_POST['edit_quantity'])){

    //    Get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

//    Get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

//    Update product quantity
    $product_array['product_quantity'] = $product_quantity;

//    Return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;

//    When quantity is edited recalculate total
    calcTotalCart();

}

function calcTotalCart(){
    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value){

//        Returns an array of each single product
        $product = $_SESSION['cart'][$key];

         $price = $product['product_price'];
         $quantity  = $product['product_quantity'];

         $total = $total + ($price * $quantity);
    }

//    Store the total in a session rather than just returning it
    $_SESSION['total'] = $total;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Css link  -->
    <link rel="stylesheet" href="/css/cart_page.css">
     <!-- font awesome cdn -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <!-- Box Icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
 
</head>
<body>

<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include $IPATH."nav_bar.html" ?>

<section class="cart container">
    <div class="container">
        <h2 class="font-weight-bold">Your Cart</h2>
        <hr>
    </div>

    <table class="">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php foreach ($_SESSION['cart'] as $key => $value){ ?>
        <tr>
            <td>
                <div class="product-info">
                    <img src="images/<?php echo $value['product_image']; ?>" alt="product_image">
                    <div class="">
                        <p><?php echo $value['product_name']; ?></p>
                        <small><span>Ksh</span><?php echo $value['product_price']; ?></small>
                        <br>
<!--                        Remove button-->
                        <form method="POST" action="cart_page.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                            <input type="submit" name="remove_product" class="remove-btn" value="remove">
                        </form>

                    </div>
                </div>
            </td>

<!--            Edit button-->
            <td>
                <form method="POST" action="cart_page.php"></form>
                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>">
                <input  type="submit" class="edit-btn" value="edit" name="edit_quantity">
            </td>

            <td>
                <span>Ksh</span>
                <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price'];?></span>
            </td>
        </tr>

        <?php } ?>

    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>Ksh <?php echo $_SESSION['total'] ?></td>
            </tr>
        </table>
    </div>

    <div class="checkout-container">
        <form action="checkout_page.php" method="POST">
            <input type="submit" class="checkout-btn" value="Checkout" name="checkout">
        </form>

    </div>


</section>


<!-- Bootstrap cdn -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="/js/cart_page.js"></script>
</body>
</html>
