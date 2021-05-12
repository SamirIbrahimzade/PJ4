<?php
include("session.php");
session_start();
$connect = open_connection();

function submit_symptoms($uname, $date, $saturation, $temperature, $breathing){
    $connect = open_connection();
    
    $query = "SELECT * FROM `user_symptom` WHERE `username` = '$uname' AND `date` = '$date'";
    $tuple = mysqli_query($connect, $query);
    $count = mysqli_num_rows($tuple);
    if ($count == 0) {
        $insert = "INSERT INTO `user_symptom`(`username`, `date`, `oxygen_saturation`, `body_temperature`, `difficulty_breathing`) VALUES ('$uname','$date','$saturation','$temperature','$breathing')";
        mysqli_query($connect, $insert);
        return 1;
    }
    else if ($count == 1) {
        $update = "UPDATE `user_symptom` SET `username`='$uname',`date`= '$date',`oxygen_saturation`= '$saturation',`body_temperature`= '$temperature',`difficulty_breathing`= '$breathing' WHERE `username` = '$uname' AND `date` = '$date'";
        mysqli_query($connect, $update);
        return 0;
    }
    header('location:home.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        header('location:logout.php');
    }
    else if (isset($_POST['home'])) {
        header('location:home.php');
    }
    else if (isset($_POST['submit_symptom'])) {
        $uname = $_SESSION['uname'];
        if ($_POST['date'] == '') {
            $date = date("Y-m-d");
        }
        else {
            $date = $_POST['date'];
        }
        $saturation = $_POST['saturation'];
        $temperature = $_POST['temperature'];
        $breathing = $_POST['breathing'];
        submit_symptoms($uname, $date, $saturation, $temperature, $breathing);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Patient Monitor System</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form class="form" id="enter_symptom" action="entry.php" method="post">
        <div class="container message">
            <h2 class=form_title">Enter Symptoms</h2>
            <br>
            <label class="form_input_group">Date:
                <input type="date" max="<?php echo date("Y-m-d"); ?>"  class="form_input" name="date">
            </label>
            <button class="form_button logout" type="submit" name="logout">Logout</button>
            <button class="form_button home" type="submit" name="home">Home</button>
            <br>
            <div class="form_input_group">
            <label class="form_input_group">Oxygen Saturation:
                <input type="number" class="form_input" name="saturation" min="0" step="0.01">
            </label>
            <br>
            <label class="form_input_group">Body Temperature:
                <input type="number" class="form_input" name="temperature" min="0" step="0.01">
            </label>
            <br>
            <div class="form_input_group">
                <p class="text">Difficulty Breathing:</p>
                <label class="button">Normal
                    <input type="radio" checked="checked" name="breathing" value="normal">
                    <span class="checkmark"></span>
                </label>
                <label class="button">Somewhat Difficult
                    <input type="radio" name="breathing" value="somewhat difficult">
                    <span class="checkmark"></span>
                </label>
                <label class="button">Difficult
                    <input type="radio" name="breathing" value="difficult">
                    <span class="checkmark"></span>
                </label>
                <label class="button">Pretty Difficult
                    <input type="radio" name="breathing" value="pretty difficult">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button id ="form_button" class="form_button" type="submit" name="submit_symptom">Submit</button>
        </div>
    </form>
</body>
</html>