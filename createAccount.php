<?php

/** @var mysqli $db */
require_once 'includes/dbconnect.php';

if (isset($_POST['submit'])) {
    if (empty(trim($_POST['email']))) {
        $errors['email'] = 'Email is required.';
    }
    if (empty(trim($_POST['password']))) {
        $errors['password'] = 'Password is required.';
    }
    elseif(strlen(trim($_POST['password'])) < 8){
        $errors['password'] = 'Password must be more than 8 characters.';
    }
    if (empty(trim($_POST['username']))) {
        $errors['username'] = 'Username is required.';
    }

    if (empty($errors)) {

        $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $newUser =
            "INSERT INTO users(username, email, password) VALUES (' " . $username . " ' , '" . $email . "', '" . $pw . "')";
        $insertAlbums = mysqli_query($db, $newUser);
        mysqli_close($db);
        header('location: login.php');
        exit;
    }
}

//}

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
    <style>
        .emailError::after{
            content: "<?= $errors['email']?>";
        }
        .passwordError::after{
            content: "<?= $errors['password']?>";
        }
        .usernameError::after{
             content: "<?= $errors['username']?>";
         }

    </style>
</head>
<body>

<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">


            <a class="navbar-item" href="index.php">
                Home
            </a>
            <a class="navbar-item" href="login.php">
                Login
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
    <div class="container has-text-centered section is-medium">
        <h1 class="title">Sign up</h1>
        <div class="form">
        <form action="" method="post">
            <div class="email emailError">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="username usernameError">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="password passwordError">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" name="submit" value="Save">
        </form>
    </div>
    </div>
</main>
</body>
</html>