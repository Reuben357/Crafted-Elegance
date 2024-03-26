<?php
global $conn;
session_start();

include 'config/connection.php';

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
     $stmt->execute();
     $order_details = $stmt->get_result();
}
else{
    header("Location: account_page.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>

<!--    Link -->
    <link rel="stylesheet" href="./css/payment_page.css">
</head>
<body>

<!-- Navbar -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include($IPATH."nav_bar.html")  ?>

<section class="payment">
    <div class="payment-container">
        <h3>Payment</h3>

        <div class="orders">
            <table class="orders-table">
                <tr>
                    <th>Product </th>
                    <th> Price </th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                </tr>

                <?php while ($row= $order_details->fetch_assoc()){ ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="/images/<?php echo $row['product_image']; ?>" alt="product_image">
                                <div>
                                    <p><?php echo $row['product_name']; ?></p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span><?php echo $row['product_price']; ?></span>
                        </td>

                        <td>
                            <span><?php echo $row['product_quantity']; ?></span>
                        </td>

                        <td>
                            <span><?php echo $row['order_date']; ?></span>
                        </td>
                    </tr>

                <?php  } ?>
            </table>

        </div>

        <div class="payment-information">
            <h5>Total payment: Ksh <?php echo $_SESSION['total'];?> </h5>
            <div class = "btn-groups">
                <input type="submit" value="Pay Now" class="payment-btn">
            </div>
        </div>
    </div>
</section>
    
</body>
</html>
