<?php
session_start();
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
            $sessionStart = "SELECT id, username, admin, email FROM `users` WHERE email = '$emailcheck'";
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
                $_SESSION['email'] = $sessionThings[0]['email'];
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
    <link rel="stylesheet" href="./style.css">
    <style>
        .errorEmail::after {
            content: "<?= $errors['email']?>";
        }

        .errorPw::after {
            content: "<?= $errors['password']?>";
        }

    </style>
</head>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item has-text-black" href="index.php">
                Home
            </a>

            <a class="navbar-item has-text-black" href="createAccount.php">
                Sign up
            </a>
        </div>
        <div class="navbar-end">
            <a class="navbar-item" href="index.php">
                <img src="./fotos/logo_CutOrDye.png" alt="logo"/>
            </a>
        </div>
    </div>
</nav>
<body>
<main class="container has-text-centered section is-medium">
    <h1 class="title" aria-label="login">login</h1>
    <div class="form">
        <form action="" method="post" class="" id="form">
            <div class="email errorEmail">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="yourEmail@example.com">
            </div>
            <div class="password errorPw">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="type ur password">
            </div>
            <input type="submit" name="submit" value="Save">
        </form>
        <form action="magicLink.php" method="post" class="is-hidden" id="magic-link-form">
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" name="email-magic-link" type="email" placeholder="Email">
                    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
                    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
                </p>
            </div>
            <input type="submit" name="submit" value="Send magic link">
        </form>
        <div class="magic-link" onclick="switchForm(this)">Login with magic link</div>
    </div>
</main>
<script>
    function switchForm(element) {
        const form = document.getElementById('form');
        const magicLinkForm = document.getElementById('magic-link-form');

        if (form.classList.contains('is-hidden')) {
            form.classList.remove('is-hidden');
            magicLinkForm.classList.add('is-hidden');
        } else {
            form.classList.add('is-hidden');
            magicLinkForm.classList.remove('is-hidden');
        }

        element.innerHTML === 'Login with magic link' ? element.innerHTML = 'Login with email' : element.innerHTML = 'Login with magic link';
    }
</script>
</body>
</html>