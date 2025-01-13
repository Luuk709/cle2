<?php
session_start();
/** @var mysqli $db*/
require_once 'includes/dbconnect.php';
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


$returnValue = "SELECT * FROM reservations ORDER BY ID DESC LIMIT 1;";
$result = mysqli_query($db, $returnValue);

foreach ($result as $row) {
    $conformation[] = $row;
}

if (isset($_POST['submit'])) {
    $deleteAlbum =
        "DELETE FROM reservations WHERE id = '$id'";
    $deleteAlbums = mysqli_query($db, $deleteAlbum);
    mysqli_close($db);
    header('location: account.php');
    exit;
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
<main>

    <section class="cancelDate section is-small ">

        <p>Are you sure you want to delete this appointment?</p>
        <div>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Datum</dt>
                <dd class="font-medium text-gray-900  sm:text-end"> <strong><?= $conformation[0]['date'] ?></strong></dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Tijd</dt>
                <dd class="font-medium text-gray-900  sm:text-end"><strong><?= $conformation[0]['time'] ?></strong></dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Knipbeurt</dt>
                <!--                <dd class="font-medium text-gray-900  sm:text-end">--><?php //= $conformation[0]['knipBeurt'] ?><!--</dd>-->
            </dl>
        </div>

<div class="section is-flex ">
         <form action="" method="post">
            <input type="submit" name="submit" value="yes">
        </form>
    <form action="./account.php">
        <input type="submit" name="submit" value="no">
    </form>
        </div>
    </section>

</main>
</body>
</html>
