<?php
session_start();
if(!isset($_SESSION['id'])) {
    header('location: ./login.php');
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getAccInfo = "SELECT * FROM `users` INNER JOIN `reservations` ON reservations.user_id = users.id WHERE users.id = ' " . $_SESSION['id'] . " '";
$resultAccInfo = mysqli_query($db, $getAccInfo)
or die('Error ');
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
            <a class="navbar-item" href="./index.php">
               Home
            </a>

            <a class="navbar-item" href="overview.php">
                Overview
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
<?php if ($resultAccInfo) :?>
    <h1 class="is-size-2">Account information</h1>
    <p>Name:<?= $_SESSION['username'] ?></p>
    <!--<p>Email: --><?php //= $AccInfo[0]['email'] ?><!--</p>-->
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
        <?php while ($results = mysqli_fetch_assoc($resultAccInfo)):?>
            <tr>
                <th class="has-text-weight-normal"> <?= htmlspecialchars($results['date']) ?></th>
                <th class="has-text-weight-normal"> <?= htmlspecialchars($results['time']) ?></th>
                <th>
                    <a class="has-text-weight-normal has-text-black" href="editAppointment.php?id=<?=$results['id']?>">Change Reservation</a>
                </th>
                <th>
                    <a class="has-text-weight-normal has-text-black" href="deleteAppointment.php?id=<?=$results['id']?>">Delete Reservation</a>
                </th>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
<?php else:?>
<!--    <div class="">Je hebt nog geen reserveringen</div>-->
<?php endif;?>
</body>
</html>
