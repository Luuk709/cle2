<?php
session_start();
/** @var mysqli $db*/
require_once 'includes/dbconnect.php';
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
</head>
<body>
<main>
    <section>
        <form action="" method="post">
            <label for="check">Are you sure you want to delete this</label>
            <input required type="checkbox" name="check" id="check" value="">
            <input type="submit" name="submit" value="Submit">


        </form>
    </section>
</main>
</body>
</html>
