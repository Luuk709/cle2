<?php
session_start();

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
                "INSERT INTO reservations(user_id, date, time)
            VALUES (' " . $_SESSION['id'] . " ' , '" . $_POST['date'] . "', '" . $_POST['time'] . "')";
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
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="makeReservation.php">
                Reserve
            </a>

            <a class="navbar-item" href="overview.php">
                Overview
            </a>
            <a class="navbar-item" href="login.php">
                Login
            </a>
            <a class="navbar-item" href="logout.php">
                Logout
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
    <h1 class="title">make a reservation</h1>
    <span style="color : red;"><?= $errors['login'] ?? '' ?></span>
    <form action="" method="post">
        <div class="is-flex">
            <label class="date" for="date"><strong>Date:</strong></label>
            <input type="date" id="date" name="date"><br>
        </div>
<div class="is-flex">
    <label class="date" for="time"><strong>Time:</strong></label>
    <select id="time" name="time">
        <option selected disabled>Choose a time</option>
        <?php foreach ($times as $time): ?>
            <option value="<?= date("H:i", strtotime($time['time'])) ?>">
                <?= date("H:i", strtotime($time['time'])) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

        <span class="subtext ">You can only book a reservation between 10am and 5pm</span><br>
        <input type="submit" name="submit" value="Save">
    </form>
</main>




</body>
</html>