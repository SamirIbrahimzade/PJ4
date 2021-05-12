<?php
include("session.php");

function login($uname, $upassword){

    $connect = open_connection();

    $query = " SELECT * FROM `user` WHERE username = '$uname' && password = '$upassword'";
    $tuples = mysqli_query($connect, $query);
    $count = mysqli_num_rows($tuples);

    if ($count == 1) {
        session_start();

        $field_info =  mysqli_fetch_assoc($tuples);
        $_SESSION['name'] = $field_info['first_name'] . " " . $field_info['last_name'];
        $_SESSION['uname'] = $uname;
        $_SESSION['upassword'] = $upassword;
        $_SESSION['date'] = date("Y-m-d");
        header('location:profile.php');
        return 1;
    } else {
        return 0;
    }
}

if (($_SERVER["REQUEST_METHOD"] ?? 'GET') == 'POST'){
    $uname = $_POST['username'];
    $upassword = $_POST['password'];
    login($uname,$upassword);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Covid-19 Patient Monitor</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="container">
    <form class="form" id="login" action="index.php" method="post">
        <h1 class="form_title">Patient Monitor System</h1>
        <div class="form_input_group">
            <input type="text" id="username" class="form_input" name="username" autofocus placeholder="username" required>
        </div>
        <div class="form_input_group">
            <input type="password" id="password" class="form_input" name="password" autofocus placeholder="password" required>
        </div>
        <button class="form_button" id ="login_button" type="submit">Login</button>
        <p class="form_text">
            <a class="form_link" href="sign_up.php" id="link_create_account"> Sign Up</a>
        </p>
    </form>
</div>
</body>
</html>