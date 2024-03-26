<?php
session_start();

global $conn;
include "config/connection.php";

if (isset($_SESSION['logged_in'])){
    header("Location: account_page.php");
    exit();
}

if (isset($_POST['login_btn'])){

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];

    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT user_id,user_name,user_password FROM user WHERE user_name=? AND user_password=? LIMIT 1");

    $stmt->bind_param('ss', $user_name, $user_password);

    if($stmt->execute()){
        $stmt->bind_result($user_id, $user_name, $user_password);
        $stmt->store_result();

        if ($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['user_id'] =  $user_id;
            $_SESSION['user_name'] =  $user_name;
            $_SESSION['logged_in'] = true;

            header("Location: account_page.php?message=logged in successfully");


        }else{
            header("Location: login_page.php?error=could not verify your account");
        }

    }else{
        header("Location: login_page.php?error=something went wrong");
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

<!--    Css link-->
    <link rel="stylesheet" href="./css/login_page.css">

    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>
<body>
<div id="login-container" class="login-container">
<!--    Left side-->
    <div id="login-image">
        <img src="./images/baseball_leather_jacket.png" alt="computer icon">
    </div>

<!--    Right side-->
    <div id="login-info" class="login-info">
        <form action="login_page.php" method="POST" class="login-form">
            <h2>Welcome <span>Back</span></h2>
            <h4 class="error-msg">
                <?php if (isset($_GET['error'])){ echo "<i class='bx bx-error bx-sm'></i>"." ".$_GET['error'];} ?></h4>
                <?php if (isset($_GET['message'])){ echo $_GET['message'];} ?></h4>
            <input type="text" placeholder="Username" class="user-name" name="user_name"><br>
            <input type="password" placeholder="Password" class="user-password" name="user_password"><br>
            <input type="submit" value="Login" name="login_btn" class="login-btn"><br>
            <p>Not registered yet? <a href="signup_page.php"> Create an Account</a> </p>
        </form>
    </div>
</div>
</body>
</html>
