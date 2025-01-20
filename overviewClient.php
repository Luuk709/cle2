<?php
session_start();
if ($_SESSION['admin'] != 1){
    header('location: login.php');
    exit();
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
//$id = $_GET['id'];
$query = "SELECT * FROM users ";

$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

$users = [];
while($row = mysqli_fetch_assoc($result))
{
    $users[] = $row;
}
mysqli_close($db);
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
</head>

<body>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>
            <?php

            if ($_SESSION['admin'] != 1){

            } elseif  (isset($_SESSION['admin'])) {
                echo '<a class="navbar-item" href="overview.php">
                Overview
            </a>';

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
        <table class="table is-striped is-fullwidth is-bordered">
            <thead>
            <tr class="has-text-weight-bold">
                <th>
                    Username
                </th>
                <th>
                    Email
                </th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user) { ?>
                    <tr>
<!--                        <td>--><?php //= ($key + 1) ?><!--</td>-->
                       <th class="has-text-weight-normal"> <a href="client.php?id=<?= htmlspecialchars($user['id']) ?>" class="client"><?= htmlspecialchars($user['username']) ?> </a></th>
                        <th class="has-text-weight-normal"> <?= htmlspecialchars($user['email']) ?></th>

                    </tr>

                <?php } ?>

            </tbody>
        </table>
    </section>
</main>
</body>
</html>

