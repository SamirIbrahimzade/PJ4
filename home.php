<?php
include("session.php");
$connect = open_connection();
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        header('location:logout.php');
    }
    else if (isset($_POST['profile'])) {
        header('location:profile.php');
    }
    else if (isset($_POST['enter_symptom'])) {
        header('location:entry.php');
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
    <form class="form" id="home" action="home.php" method="post">
        <div class="container message">
            <h2 class=form_title"><?php echo ucfirst(($_SESSION['name'])); ?>'s Symptoms</h2>
            <table class="date table">
            <tr class="date row">
                <td class="date data">
                    <label class="form_input_group">
                        <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form_input" name="date">
                    </label></td>
                <td class="date button_data"><button class="form_button update" id="update" type="submit" name="update">Select</button></td>
            </tr>
            </table>
            <button class="form_button logout" type="submit" name="logout">Logout</button>
            <button class="form_button profile" type="submit" name="profile">Profile</button>
            <br>
            <?php
            $uname = $_SESSION['uname'];
            $query = "SELECT * FROM `user_symptom` WHERE `username` = '$uname' ORDER BY `date` DESC LIMIT 1";
            $tuple = mysqli_query($connect, $query);
            $count = mysqli_num_rows($tuple);

            if($count == 1) {
                if (isset($_POST['update'])) {
                    $uname = $_SESSION['uname'];
                    $date = $_POST['date'];
                    $_SESSION['date'] = $date;
                    $query = "SELECT * FROM `user_symptom` WHERE `username` = '$uname' AND `date` = '$date'";
                    $tuple = mysqli_query($connect, $query);
                    $count = mysqli_num_rows($tuple);
                } else {
                    $uname = $_SESSION['uname'];
                    $query = "SELECT * FROM `user_symptom` WHERE `username` = '$uname' ORDER BY `date` DESC LIMIT 1";

                    $tuple = mysqli_query($connect, $query);
                    $field_info = mysqli_fetch_assoc($tuple);
                    $_SESSION['date'] = $field_info['date'];

                    $tuple = mysqli_query($connect, $query);
                    $count = mysqli_num_rows($tuple);
                }

                if ($count == 1) {
                    echo '    
                    <table class="home_table">         
                    <caption>Critical Symptoms</caption>   
                    <tr class="row">
                        <th class="header">Oxygen Saturation</th>
                        <th class="header">Body Temperature</th>
                        <th class="header">Difficulty Breathing</th>
                    </tr>';
                    while ($fetch = mysqli_fetch_array($tuple)) {
                        echo '
                    <tr class="row">
                        <td class="data">%' . $fetch['oxygen_saturation'] . '</td>
                        <td class="data">' . $fetch['body_temperature'] . ' &#8451</td>
                        <td class="data">' . $fetch['difficulty_breathing'] . '</td>
                    </tr>';
                    }
                    echo '</table>';

                    $date = $_SESSION['date'];
                    $query = "SELECT * FROM `user_symptom` WHERE `username` = '$uname' AND `date` = '$date'";
                    $tuple = mysqli_query($connect, $query);
                    $field_info = mysqli_fetch_assoc($tuple);

                    if ($field_info['oxygen_saturation'] < 94 || $field_info['body_temperature'] > 38.5 ||
                        strcmp($field_info['difficulty_breathing'], "difficult") == 0 || strcmp($field_info['difficulty_breathing'], "pretty difficult") == 0) {
                        echo '<h3 class="form_title alert">Your symptoms are severe!</h3>';
                        echo '<h3 class="form_title alert">Please seek professional help!</h3>';
                    }
                }
            }
            else {
                echo '<h3 class=form_title">No symptoms have been entered</h3>';
            }
            ?>
            <h4 class=form_title">Selected date: <?php echo ($_SESSION['date']); ?></h4>
            <button id ="form_button" class="form_button" type="submit" name="enter_symptom">Enter Symptoms</button>
        </div>
    </form>
</body>
</html>