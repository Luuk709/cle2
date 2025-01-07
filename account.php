<?php
session_start();
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getAccInfo = "SELECT * FROM `users` INNER JOIN `reservations` ON reservations.user_id = users.id WHERE users.id = ' " . $_SESSION['id'] . " '";
$resultAccInfo = mysqli_query($db, $getAccInfo)
or die('Error ');

$AccInfo = [];

// Alle resultaten ophalen
while($row = mysqli_fetch_assoc($resultAccInfo))
{
    $AccInfo[] = $row;
}
mysqli_close($db);
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
<h1 class="is-size-2">Account information</h1>
<p>Name:<?= $AccInfo[0]['username'] ?></p>
<p>Email: <?= $AccInfo[0]['email'] ?></p>
<h1 class="is-size-2">Reservation information</h1>
<p>Date: <?=$AccInfo[0]['date']?></p>
<p>Time: <?=$AccInfo[0]['time']?></p>
<form action="editAppointment.php">
    <input type="submit" value="Change appointment">
</form>
<form action="">
    <input type="submit" value="Cancel appointment">
</form>
</body>
</html>
