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

$AccInfo = [];

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<form action="" method="post">
    <label for="date">Date:</label>
    <input type="date" id="datePicker" name="date"><br>
    <div class="formContainer"></div>
    <input type="submit" name="submit" value="Save">
</form>




<script>
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
</script>
</body>
</html>
