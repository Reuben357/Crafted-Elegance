<?php
global $conn;
session_start();

include ('connection.php');

if (isset($_POST['place_order'])){
//Get user info and store it in the db
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');
//Issues new order and store order info in db
   $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address,order_date)
                VALUES (?,?,?,?,?,?,?);");

   $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

   $stmt->execute();
//   returns the order id
   $order_id = $stmt->insert_id;


//Get products from cart (from session)
    foreach ($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];//Returns an array of each single product
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $product_image = $product['product_image'];
        $product_quantity = $product['product_quantity'];

        //Store each single item in order_items database
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                VALUES (?,?,?,?,?,?,?,?)");
        $stmt1->bind_param('iissiiis', $order_id,$product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }

//    Remove everything from cart
   // unset($_SESSION['cart']);

//    Inform user whether everything is fine or there is a problem and direct to payment page
    header('Location: ../payment_page.php?order=order successfully placed');


}
?>

