<?php
session_start();

/** @var mysqli $db */
require_once 'includes/dbconnect.php';
?>

<html lang="en" data-theme="white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>CutOrDye</title>
</head>

<nav  class="navbar" role="navigation" aria-label="main navigation" >
        <div id="navbarBasicExample" class="navbar-menu" style="background-color: #C4C4C4">
            <div class="navbar-start" >
                <a class="navbar-item" href="#">
                    <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
                </a>
            </div>
            <div class="navbar-end" >
                <?php
                if (!isset($_SESSION['id'])) {
                  echo '<a class="column" href="./login.php" >Login</a>' ;
                }

                ?>

                <?php
                if (isset($_SESSION['id'])) {
                    echo '<a class="column is-full" href="./account.php">My Account</a>';
                }
                ?>

            </div>
        </div>
    </nav>
</html>