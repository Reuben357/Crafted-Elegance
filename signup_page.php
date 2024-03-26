<?php

global $conn;
include "config/connection.php";

//Check if user is logged in
  if (isset($_SESSION['logged_in'])){
        header("Location: account_page.php");
        exit();
    }

if ($_SERVER['REQUEST_METHOD'] == "POST"){

//    Something was posted
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];


    $query_username = "SELECT * FROM user WHERE user_name='$user_name'";
    $query_email = "SELECT * FROM user WHERE user_email='$user_email'";
    $query_resultUsername = mysqli_query($conn, $query_username); //Saves data to the db
    $query_resultEmail = mysqli_query($conn, $query_email);

//    Check if input forms are empty
    if (empty($user_name) || empty($user_email) || empty($user_password) || is_numeric($user_name)){
        header("Location: signup_page.php?error=empty_fields&user_name=".$user_name."&user_email=".$user_email);
    }
    elseif ($user_password !== $confirm_password){
        header("Location: signup_page.php?error=passwords_dont_match".$user_name."&user_email=".$user_email);
    }
    elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
        header("Location: signup_page.php?error=invalid_info");
    }
    elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        header("Location: signup_page.php?error=invalid_user_name&user_name".$user_name);
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $user_name)){
        header("Location: signup_page.php?error=invalid_email&user_name".$user_email);
    }
    elseif (mysqli_num_rows($query_resultUsername) > 0){
        echo "Username already exist";
    }
    elseif (mysqli_num_rows($query_resultEmail) > 0){
        echo "Email already exist";
    }

//    save to db
    else{
//        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO user(user_name, user_email, user_password)
            VALUES (?,?,?)");
        $stmt->bind_param('sss', $user_name, $user_email, $user_password);

//        Check if account was created successfully
        if ($stmt->execute()){
            $user_id = $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;
            header('Location: account_page.php?signup=Signed Up successfully');
        }
        else{
            header('Location: signup_page.php?error=Could not create an account');
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

<!--    Css link-->
    <link rel="stylesheet" href="./css/signup_page.css">
</head>
<body>
<div id="signup-container">
    <!--    Left side-->
    <div id="signup-image">
        <img src="./images/baseball_leather_jacket.png" alt="computer icon">
    </div>

    <!--    Right side-->
    <div id="signup-info">
        <form action="" method="POST" class="signup-form">
            <h2>Create An <span>Account</span></h2>
            <input type="text" placeholder="Username" class="user-name" name="user_name"><br>
            <input type="email" placeholder="Email" class="user-email" name="user_email"><br>
            <input type="password" placeholder="Password" class="user-password" name="user_password"><br>
            <input type="password" placeholder="Confirm password" class="confirm-password"
                   name="confirm_password"><br>
            <input type="submit" name="signup_submit" class="signup-btn" value="Sign Up"><br>
            <p>Already have an Account? <a href="login_page.php"> Click to Login</a> </p>
        </form>
    </div>
</div>

</body>
</html>
