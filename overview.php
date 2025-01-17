<?php
session_start();
if ($_SESSION['admin'] != 1){
    header('location: login.php');
    exit();
}
/** @var mysqli $db */


?>
<!doctype html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>
            <a class="navbar-item" href="overviewClient.php">
                Clients
            </a>
            <a class="navbar-item" href="./account.php">My Account</a>
        </div>
        <div class="navbar-end" >
            <a class="navbar-item" href="index.php">
                <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
            </a>
        </div>
    </div>
</nav>
<section class="overviewSection">
    <div>
<div class="calendar">
    <div class="calendar-header">
        <button id="prev-month">‹</button>
        <div id="month-year"></div>
        <button id="next-month">›</button>
    </div>
    <div id = "testing" class="calendar-body">
        <div class="calendar-weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="calendar-dates">

        </div>
    </div>
</div>

<div id="formContainer">

</div>
    </div>
</section>
<script src="script.js"></script>
</body>
</html>
