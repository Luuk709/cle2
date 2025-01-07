<?php
session_start();
if ($_SESSION['admin'] != 1){
    header('location: login.php');
    exit();
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getReservationDetails = "SELECT date, time, username, email FROM reservations
INNER JOIN users ON reservations.user_id = users.id";
$resultReservations = mysqli_query($db, $getReservationDetails)
or die('Error ');

$reservations = [];

// Alle resultaten ophalen
while($row = mysqli_fetch_assoc($resultReservations))
{
    $reservations[] = $row;
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
        </div>
    </div>
</nav>
<main>
    <section class="section container">
        <table class="table is-striped is-fullwidth is-bordered">
            <thead>
            <tr class="has-text-weight-bold">
                <th>
                    Username
                </th>
                <th>
                    Email
                </th>
                <th>
                    Date
                </th>
                <th>
                    Time
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($reservations as $reservation) { ?>
                <tr>
                    <th class="has-text-weight-normal"><?= htmlspecialchars($reservation['username']) ?></th>
                    <th class="has-text-weight-normal"> <?= htmlspecialchars($reservation['email']) ?></th>
                    <th class="has-text-weight-normal"> <?= htmlspecialchars($reservation['date']) ?></th>
                    <th class="has-text-weight-normal"> <?= htmlspecialchars($reservation['time']) ?></th>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
