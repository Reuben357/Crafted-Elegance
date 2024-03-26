<?php
global $conn;
session_start();

include 'config/connection.php';

if (!isset($_SESSION['logged_in'])){
    header("Location: login_page.php");
    exit();
}

if (isset($_GET['logout'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    header("Location: login_page.php");
    exit();
}

if (isset($_POST['update_password'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_email = $_SESSION['user_email'];

    if ($password !== $confirm_password){
        header("Location: account_page.php?error=passwords dont match");
    }
//    Update the password
    else{
        $stmt = $conn->prepare("UPDATE user SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss', $password,$user_email );
        if ($stmt->execute()){
            header("Location: account_page.php?message=password updated successfully");
        }
        else{
            header("Location: account_page.php?error=error could not update password");
        }
    }
}

//Get orders
if (isset($_SESSION['logged_in'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param('i', $user_id);

    $stmt->execute();
    $orders = $stmt->get_result();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <!-- Account Css Link -->
    <link rel="stylesheet" href="/css/account_page.css">


</head>
<body>

<!--Navbar Link -->
<?php $IPATH = $_SERVER["DOCUMENT_ROOT"]."/assets/php/"; include($IPATH."nav_bar.html")  ?>

    <!-- Account -->
    <section class="account" id="account">
<!--        Account Information-->
        <div class="account-container container">
            <div class="account-settings">
                <div class="account-information">
                    <div class="user-profile">
                        <div class="user-avatar">
                            <img src="/images/avatar.png" alt="Avatar">
                        </div>
                        <h4 class="user-name"><?php if (isset($_SESSION['user_name'])){
                                echo $_SESSION['user_name'];
                            } ?></h4>
                        <a href="">Your Orders</a><br>
                        <a href="account_page.php?logout=1">Log Out</a>
                     </div>

                </div>

                <div class="user-form">
                    <div class="user-content">
                        <form action="account_page.php" method="POST">
<!--                            Displays the error and success msg-->
                            <p class="error-msg"><?php if (isset($_GET['error'])){
                                echo $_GET['error'];
                                } ?></p>
                            <p class="success-msg"><?php if (isset($_GET['message'])){
                                    echo $_GET['message'];
                                } ?></p>
                            <h2>Change <span>Password</span></h2>
                            <label for="">Password</label><br>
                            <input type="password"  name="password"><br>

                            <label for="">Confirm Password</label><br>
                            <input type="password" name="confirm_password">

                            <div class = "btn-groups">
                                <button type="submit" class="update" name="update_password">Update</button>
                            </div>

                        </form>
                      </div>

                </div>
            </div>
        </div>
    </section>

<section class="orders container">
    <h4>Your <span>Orders</span> </h4>
    <table class="orders-table">
        <tr>
            <th>Order ID</th>
            <th>Order Cost</th>
            <th>Order Status</th>
            <th>Order Date</th>
        </tr>

        <?php while ($row = $orders->fetch_assoc()){ ?>
        <tr>
            <td>
                <span><?php echo $row['order_id']; ?></span>
            </td>

            <td>
                <?php echo $row['order_cost']; ?>
            </td>

            <td>
                <span><?php echo $row['order_status']; ?></span>
            </td>

            <td>
                <span><?php echo $row['order_date']; ?></span>
            </td>

            <td>
                <form action="payment_page.php" method="POST" class="order-details-form">
                    <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                    <input type="submit" class="order-details" name="order_details_btn" value="details">
                </form>
            </td>
        </tr>

        <?php } ?>

    </table>
</section>

</body>
</html>
