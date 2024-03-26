<?php

function checkLogin($conn){
    if (isset($_SESSION['user_id'])){
//        Check if user id is in the db

        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM user WHERE  user_id = '$user_id' LIMIT 1";

//        Read from the db
        $result = mysqli_query($conn, $query);
//        Check if result is +ve
        if ($result && mysqli_num_rows($result) > 0){
            return mysqli_fetch_assoc($result);
        }
    }

//    Redirect to login
    header("Location: login_page.php");
    die;
}
