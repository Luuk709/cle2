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

$AccInfo = [];

// Alle resultaten ophalen
while($row = mysqli_fetch_assoc($resultAccInfo))
{
    $AccInfo[] = $row;
}
mysqli_close($db);
$i = 0;
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

<?php



if (!isset($_SESSION['id'])) {
    echo ' <h1 class="title" style="text-align: center">must be logged in to delete </h1>';

    echo '<button class="button is-fullwidth table ">
            <a href="./login.php" class=" ">login</a>
        </button>';
    echo '<button class="is-fullwidth  ">
            <a href="./index.php" class=" ">	go back</a>
        </button>';

//            header("Location: login.php");
    exit;
}
?>

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

<main>

<div class="box-content">
    <h1 class="is-size-2">Account information</h1>
        <p> <strong>Name:</strong><?= $AccInfo[0]['username'] ?></p>
        <p><strong>Email:</strong> <?= $AccInfo[0]['email'] ?></p>
    </div>

    <div class="section ">
    <h2 class="is-size-2">Reservation information</h2>
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
                <th class="has-text-weight-normal "> <?= htmlspecialchars($results['date']) ?></th>
                <th class="has-text-weight-normal"> <?= htmlspecialchars($results['time']) ?></th>
                <th>
                    <a class="has-text-weight-normal has-text-black" href="editAppointment.php?id=<?=$AccInfo[$i]['id']?>">Change Reservation</a>
                </th>
                <th>
                    <a class="has-text-weight-normal has-text-black" href="deleteAppointment.php?id=<?=$AccInfo[$i]['id']?>">Delete Reservation</a>
                </th>
            </tr>
            <?php $i++;
        } ?>
        </tbody>
    </table>
    </div>
</main>

</body>
</html>
