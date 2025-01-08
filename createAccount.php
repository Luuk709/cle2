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
</head>
<body>
<h1 class="title">Sign up</h1>
<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <span style="color : red;"><?= $errors['email'] ?? '' ?></span><br>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <span style="color : red;"><?= $errors['username'] ?? '' ?></span><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <span style="color : red;"><?= $errors['password'] ?? '' ?></span><br>
    <input type="submit" name="submit" value="Save">


</form>
</body>
</html>