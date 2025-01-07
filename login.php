<?php

/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$errors = [];
if (isset($_POST['submit'])) {
    if (empty(trim($_POST['email']))) {
        $errors['email'] = 'Email is required.';
    }
    if (empty(trim($_POST['password']))) {
        $errors['password'] = 'Password is required.';
    }
    $emailcheck = '';
    if (empty($errors)) {
        $emailcheck = $_POST['email'];
        $checkpw = "SELECT PASSWORD AS 'pass' FROM `users` WHERE email = '$emailcheck'";
        $result = mysqli_query($db, $checkpw)
        or die('Error');
        if (mysqli_num_rows($result) === 0) {
            echo "Onbekend e-mailadres.";
        } else {
            $passwords = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $passwords[] = $row;
            }

            foreach ($passwords as $password) {
                $passwordCheck = $password['pass'];
            }
            $sessionStart = "SELECT id, username, admin FROM `users` WHERE email = '$emailcheck'";
            $resultSession = mysqli_query($db, $sessionStart)
            or die('Error');
            $sessionThings = [];

            while ($row = mysqli_fetch_assoc($resultSession)) {
                $sessionThings[] = $row;
            }
            mysqli_close($db);
            foreach ($sessionThings as $sessionId) {
                $id = $sessionId;
            }
            if (password_verify($_POST['password'], $passwordCheck)) {
                session_start();
                $_SESSION['id'] = $id['id'];
                $_SESSION['username'] = $sessionThings[0]['username'];
                $_SESSION['admin'] = $sessionThings[0]['admin'];
                header('location: makeReservation.php');
                exit;
            } else {
                echo "Ongeldige emailadres of wachtwoord";
            }
        }
    }
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
</head>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                Home
            </a>

            <a class="navbar-item" href="createacc.php">
                Sign up
            </a>
        </div>
    </div>
</nav>
<body>
<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <span style="color : red;"><?= $errors['email'] ?? '' ?></span><br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    <span style="color : red;"><?= $errors['password'] ?? '' ?></span><br>
    <input type="submit" name="submit" value="Save">


</form>
</body>
</html>