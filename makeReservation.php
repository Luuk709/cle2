<?php
session_start();

/** @var mysqli $db */
require_once 'includes/dbconnect.php';
if (isset($_POST['submit'])){
    if (isset($_SESSION['id']) && $_SESSION['id'] !== '') {
        $newReservation =
            "INSERT INTO reservations(user_id, date, time)
 VALUES (' " . $_SESSION['id'] . " ' , '" . $_POST['date'] . "', '" . $_POST['time'] . "')";
        $insertReservation = mysqli_query($db, $newReservation);
        mysqli_close($db);
    }
    else{
        $errors['login']= "You need to login before making a reservation";
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
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
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
    </div>
</nav>
<h1 class="title">Make a reservation</h1>
<span style="color : red;"><?= $errors['login'] ?? '' ?></span>
<form action="" method="post">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date"><br>
<label for="time">Time:</label>
<input type="time" id="time" name="time" min="9:00" max="18:00" step="900">
<span >You can only book a reservation between 9am and 6pm</span><br>
<input type="submit" name="submit" value="Save">


</form>
</body>
</html>