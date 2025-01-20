<?php
session_start();
//security shit
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getReservationInfo = "SELECT * FROM `reservations` WHERE id = ' " . $id . " '";
$resultReservationInfo = mysqli_query($db, $getReservationInfo)
or die('Error ');

$reservationInfo = [];

// Alle resultaten ophalen
while($row = mysqli_fetch_assoc($resultReservationInfo))
{
    $reservationInfo[] = $row;
}
if (isset($_POST['submit'])) {
    $changeReservation = "UPDATE `reservations` SET date = ' " . $_POST['date'] . " ' , time = ' " . $_POST['time'] . " ' WHERE id = '$id' ";
    mysqli_query($db, $changeReservation) or die('Error ');

    mysqli_close($db);
    header('location: account.php');
    exit;
}

?>
<!doctype html>

<html   lang="en" data-theme="light">
<head >
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body onload="firstLoad(date)">

<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="./index.php">
                Home
            </a>

            <a class="navbar-item" href="overview.php">
                Overview
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
<div class="form section is-medium">

<form action="" method="post">
    <label for="datePicker">Date:</label>
    <input type="date" id="datePicker" name="date" value="<?=$reservationInfo[0]['date'] ?>"><br>
    <div id="formContainer"></div>
    <input type="hidden" id="userId" name="userId" value="<?=$id?>">
    <input type="submit" name="submit" value="Save">
</form>
</div>
<?=$_GET['id'];?>


<script defer>
    const datePicker = document.getElementById("datePicker");

    datePicker.addEventListener("change", function () {
        const selectedDate = datePicker.value;
        loadXMLDoc(selectedDate);
    });

    function loadXMLDoc(selectedDate) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("formContainer").innerHTML = this.responseText;
            }
        };


        xhttp.open("GET", `date-checking.php?q=${selectedDate}`, true);
        xhttp.send();
    }
    const date = datePicker.value;
    const id = document.getElementById("userId")
    const idValue = id.value
    function firstLoad(date) {
        loadXMLDoc(date)

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById("formContainer").innerHTML = this.responseText;
            }
        };


        xhttp.open("GET", `edit-date-checking.php?q=${date}&id=${idValue}`, true);
        xhttp.send();
    }
</script>
</body>
</html>
