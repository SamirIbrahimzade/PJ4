<?php
include("session.php");
session_start();
$connect = open_connection();

function updateprofile($gender, $marital_status, $birthdate, $weight, $height, $uname){
    $connect = open_connection();


    $query = "INSERT INTO `user_information`(username, gender, marital_status, birthdate, weight, height) VALUES('$uname', '$gender', '$marital_status', '$birthdate', '$weight', '$height')";
    mysqli_query($connect, $query);

    echo '<script>alert("Profile update successful")</script>';
    header('location:home.php');
    return 1;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        header('location:logout.php');
    }
    else if (isset($_POST['home'])) {
        header('location:home.php');
    }
    else if (isset($_POST['profile'])) {
        $gender = $_POST['gender'];
        $marital_status = $_POST['marital_status'];
        $birthdate = $_POST['birthdate'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $uname = $_SESSION['uname'];
        updateprofile($gender, $marital_status, $birthdate, $weight, $height, $uname);
    }
}
?>


<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Patient Monitor System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<form class="form" id="update_profile" action="profile.php" method="post">
    <div class="container message">
    <h1 class="form_title"><?php echo ucfirst(($_SESSION['name'])); ?>'s Profile </h1>
    <button class="form_button logout" type="submit" name="logout">Logout</button>
    <button class="form_button home"  type="submit" name="home">Home</button>
    <div class="form_input_group">
        <p class="text">Gender:</p>
        <label class="button">Male
            <input type="radio" checked="checked" name="gender" value="male">
            <span class="checkmark"></span>
        </label>
        <label class="button">Female
            <input type="radio" name="gender" value="female">
            <span class="checkmark"></span>
        </label>
        <label class="button">Other
            <input type="radio" name="gender" value="other">
            <span class="checkmark"></span>
        </label>
    </div>
    <div class="form_input_group">
        <p class="text">Marital Status:</p>
        <label class="button">Single
            <input type="radio" checked="checked" name="marital_status" value="single">
            <span class="checkmark"></span>
        </label>
        <label class="button">Married
            <input type="radio" name="marital_status" value="married">
            <span class="checkmark"></span>
        </label>
        <label class="button">Divorced
            <input type="radio" name="marital_status" value="divorced">
            <span class="checkmark"></span>
        </label>
        <label class="button">Widowed
            <input type="radio" name="marital_status" value="widowed">
            <span class="checkmark"></span>
        </label>
    </div>
    <label class="form_input_group">Birthdate:
        <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form_input" name="birthdate">
    </label>
    <br>
    <label class="form_input_group">Weight:
        <input type="number" class="form_input" name="weight" min="0">
    </label>
    <br>
    <label class="form_input_group">Height:
        <input type="number" class="form_input" name="height" min="0">
    </label>
    <br>
    <button class="form_button" type="submit" name="profile">Submit</button>
    </div>
</form>
</body>