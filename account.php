<?php
session_start();
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getAccInfo = "SELECT * FROM `users` INNER JOIN `reservations` ON reservations.user_id = users.id WHERE users.id = ' " . $_SESSION['id'] . " '";
$resultAccInfo = mysqli_query($db, $getAccInfo)
or die('Error ');

if ($resultAccInfo) {
    $AccInfo = [];

// Alle resultaten ophalen
    while($row = mysqli_fetch_assoc($resultAccInfo))
    {
        $AccInfo[] = $row;
    }
    mysqli_close($db);
    $i = 0;
    $empty = false;
} else {
    $empty = true;
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
    <link rel="stylesheet" href="style.css">
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
<?php if ($empty) :?>
<h1 class="is-size-2">Account information</h1>
<p>Name:<?= $AccInfo[0]['username'] ?></p>
<p>Email: <?= $AccInfo[0]['email'] ?></p>
<h1 class="is-size-2">Reservation information</h1>
<table class="table is-striped is-fullwidth is-bordered">
    <thead>
    <tr class="has-text-weight-bold">
        <th>
            Date
        </th>
        <th>
            Time
        </th>
        <th>
            Change
        </th>
        <th>
            Delete
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($AccInfo as $results) {?>
        <tr>
            <th class="has-text-weight-normal"> <?= htmlspecialchars($results['date']) ?></th>
            <th class="has-text-weight-normal"> <?= htmlspecialchars($results['time']) ?></th>
            <th>
                <a class="has-text-weight-normal" href="editAppointment.php?id=<?=$AccInfo[$i]['id']?>">Change Reservation</a>
            </th>
            <th>
                <a class="has-text-weight-normal" href="deleteAppointment.php?id=<?=$AccInfo[$i]['id']?>">Delete Reservation</a>
            </th>
        </tr>
    <?php $i++;
    } ?>
    </tbody>
</table>
<?php else:?>
<div class="">Je hebt nog geen reserveringen</div>
<?php endif;?>
</body>
</html>
