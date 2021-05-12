<?php
include("session.php");

function signup($first_name, $last_name, $uname, $upassword){
    $connect = open_connection();


    $query = "SELECT * FROM `user` WHERE username = '$uname'";
    $tuples = mysqli_query($connect, $query);
    $count = mysqli_num_rows($tuples);

    if ($count == 1) {
        echo '<script>alert("This username already taken")</script>';
        return 0;
    }
    else {
        $register = "INSERT INTO `user`(first_name, last_name, username, password) VALUES('$first_name', '$last_name', '$uname', '$upassword')";
        mysqli_query($connect, $register);
        echo '<script>alert("Registration successful")</script>';
        header('location:index.php');
        return 1;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $uname = $_POST['username'];
    $upassword = $_POST['password'];
    signup($first_name, $last_name, $uname, $upassword);
}

?>

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Patient Monitor System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div  class="container">
<form class="form" id="create_account" action="sign_up.php" method="post">
    <h1 class="form_title">Create Account</h1>
    <div class="form_message form_error_message" id="sign_up_error"></div>
    <div class="form_input_group">
        <input type="text" class="form_input" name="first_name" autofocus placeholder="First Name" required>
        <div class="form_input_error_message"></div>
    </div>
    <div class="form_input_group">
        <input type="text" class="form_input" name="last_name" autofocus placeholder="Last Name" required>
        <div class="form_input_error_message"></div>
    </div>
    <div class="form_input_group">
        <input type="text" class="form_input" name="username" autofocus placeholder="Username" required>
        <div class="form_input_error_message"></div>
    </div>
    <div class="form_input_group">
        <input type="password" class="form_input" name="password" autofocus placeholder="Password" required>
        <div class="form_input_error_message"></div>
    </div>
    <button class="form_button" type="submit">Sign up</button>
    <p class="form_text">
        <a class="form_link" href="index.php" id="link_login">Already have an account? Sign in</a>
    </p>
</form>
</div>
</body>
