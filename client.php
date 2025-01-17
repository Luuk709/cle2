<?php
session_start();
if ($_SESSION['admin'] != 1){
    header('location: login.php');
    exit();
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$id = $_GET['id'];
$query = "SELECT * FROM users  WHERE id = $id ";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$users = mysqli_fetch_assoc($result);

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
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="./index.php">
                Home
            </a>
            <?php

            if ($_SESSION['admin'] != 1){

            } elseif  (isset($_SESSION['admin'])) {
                echo '<a class="navbar-item" href="overview.php">
                Overview
            </a>';
//                echo '  <a class="navbar-item" href="overviewClient.php">
//                Clients
//            </a>';
            }


            ?>

        </div>
        <div class="navbar-end" >
            <a class="navbar-item" href="index.php">
                <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
            </a>
        </div>
    </div>
</nav>

<main>
    <section class="section container">
       <p>  username: <?= $users['username'] ?></p>
        <p> email: <?= $users['email'] ?></p>
    </section>
</main>
</body>
</html>

