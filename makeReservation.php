<?php
session_start();
$type_id = '';
if (isset($_GET['id'])) {
    $type_id = $_GET['id'];
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getDateAndTimes = "SELECT date, time FROM reservations";
$collectDatesAndTimes = mysqli_query($db, $getDateAndTimes);
$dateAndTime = [];
// Alle resultaten ophalen
while ($row = mysqli_fetch_assoc($collectDatesAndTimes)) {
    $dateAndTime[] = $row;
}
$getTimes = "SELECT time FROM appointment_times";
$collectTimes = mysqli_query($db, $getTimes);
$times = [];
// Alle resultaten ophalen
while ($row = mysqli_fetch_assoc($collectTimes)) {
    $times[] = $row;
}

if (isset($_POST['submit'])) {
    $checkDateAndTime = [];
    if (isset($_SESSION['id']) && $_SESSION['id'] !== '') {
        //Check if date and time is in use
        foreach ($dateAndTime as $dates) {
            if ($dates['date'] == $_POST['date'] && date("H:i", strtotime($dates['time'])) == $_POST['time']) {
                $checkDateAndTime[] = "check";


            }
        }
        if (!$checkDateAndTime) {
            $newReservation =
                "INSERT INTO reservations(user_id, date, time, appointment_type)
            VALUES (' " . $_SESSION['id'] . " ' , '" . $_POST['date'] . "', '" . $_POST['time'] . "','". $_POST['type']."')";
            $insertReservation = mysqli_query($db, $newReservation);
            mysqli_close($db);
            header('Location: ./bevestiging.php');
        }
        else{
            echo " <div class='notification is-warning'>
 <button class='delete'></button>
That date is already booked 
 </div>";
        }
    }    else {
        $errors['login'] = "You need to login before making a reservation";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        .errors::after{
            content: "<?= $errors['login']?>";
        }
    </style>
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="./index.php">
                Home
            </a>
            <a class="navbar-item" href="#">
                About
            </a>
            <a class="navbar-item" href="account.php">
                My account
            </a>
        </div>
        <div class="navbar-end" >
            <a class="navbar-item" href="index.php">
                <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
            </a>
        </div>
    </div>
</nav>
<main class="section is-medium">
    <h1 class="title">Make a reservation</h1>
    <span style="color : red;"><?= $errors['login'] ?? '' ?></span>
    <div class="errors"></div>
    <form action="" method="post">
        <div class="is-flex">
            <label for="datePicker"><strong>Date:</strong></label>
            <input type="date" id="datePicker" name="date">
        </div>
        <div class="is-flex" id="formContainer"></div>
        <input type="hidden" id="type" name="type" value="<?=$type_id?>">
        <input type="submit" name="submit" value="Save">
    </form>
    <script>
        const datePicker = document.getElementById("datePicker");

        datePicker.addEventListener("change", function () {
            const selectedDate = datePicker.value;
            loadXMLDoc(selectedDate);
        });

        function loadXMLDoc(selectedDate) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    document.getElementById("formContainer").innerHTML = this.responseText;
                }
            };


            xhttp.open("GET", `date-checking.php?q=${selectedDate}`, true);
            xhttp.send();
        }
    </script>
</body>
</html>