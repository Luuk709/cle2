<?php
session_start();
require_once 'includes/dbconnect.php';
/** @var mysqli $db */

$returnValue = "SELECT * FROM reservations ORDER BY ID DESC LIMIT 1;";
$result = mysqli_query($db, $returnValue);

foreach ($result as $row) {
    $conformation[] = $row;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body class="h-screen w-screen overflow-hidden flex justify-center items-center">
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
<main> <section class="bg-white py-8 antialiased  md:py-16">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">

            <h2 class="title mt-4">bedankt voor het inplannen van een afspraak.</h2>
            <div class="bevestiging">
            <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6   mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Datum</dt>
                    <dd class="font-medium text-gray-900  sm:text-end"><?= $conformation[0]['date'] ?></dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Tijd</dt>
                    <dd class="font-medium text-gray-900  sm:text-end"><?= $conformation[0]['time'] ?></dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 ">Knipbeurt</dt>
                    <!--                <dd class="font-medium text-gray-900  sm:text-end">--><?php //= $conformation[0]['knipBeurt'] ?><!--</dd>-->
                </dl>
            </div>

        </div>
            <div class="flex items-center space-x-4">
                <a href="./index.php" class="bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none ">Ga terug naar de hoofdpagina</a>
            </div>
    </section>

</main>

</body>
</html>
