<?php
$q = $_GET['q'];
$id = $_GET['id'];
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getDateAndTimes = "SELECT date, time FROM reservations WHERE date = '$q' ";
$collectDatesAndTimes = mysqli_query($db, $getDateAndTimes);
$dateAndTime = [];
// Alle resultaten ophalen
while ($row = mysqli_fetch_assoc($collectDatesAndTimes)) {
    $dateAndTime[] = $row;
}

$getTimes = "SELECT time FROM appointment_times";
$collectTimes = mysqli_query($db, $getTimes);
$times = [];
// Alle resultaten ophalen
while ($row = mysqli_fetch_assoc($collectTimes)) {
    $times[] = $row;
}

$getReservationInfo = "SELECT time FROM `reservations` WHERE id = ' " . $id . " '";
$resultReservationInfo = mysqli_query($db, $getReservationInfo)
or die('Error ');

$reservationInfo = [];

// Alle resultaten ophalen
while($row = mysqli_fetch_assoc($resultReservationInfo))
{
    $reservationInfo[] = $row;
}

//check which times are full
$allTimes=[];
$availableTimes =[];
foreach ($dateAndTime as $dates){
    $availableTimes[] = $dates['time'];
}
foreach ($times as $time) {
    $allTimes[] = $time['time'];
}
$unique1 = array_diff($availableTimes, $allTimes);
$unique2 = array_diff($allTimes, $availableTimes);
$allAvailableTimes = array_merge($unique2, $unique1);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<label for="time">Time:</label>
<select id="time" name="time">
    <option selected> <?=date("H:i", strtotime($reservationInfo[0]['time']))?> </option>
    <?php foreach ($allAvailableTimes as $dates): ?>
        <option value="<?= date("H:i", strtotime($dates)) ?>">
            <?= date("H:i", strtotime($dates)) ?>
        </option>
    <?php endforeach; ?>
</select>
</body>
</html>



