
<?php
$q = $_GET['q'];
/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getAppointments = "SELECT email, time FROM reservations
INNER JOIN users on reservations.user_id = users.id WHERE date = '$q' ORDER BY time";
$collectAppointments = mysqli_query($db, $getAppointments);
$appointments = [];
// Alle resultaten ophalen
while ($row = mysqli_fetch_assoc($collectAppointments)) {
    $appointments[] = $row;
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
</head>
<body>
<?php
echo $q;
?>
<br>
<?php
if ($appointments){
foreach ($appointments as $appointment) {
    echo $appointment['email'];
    echo " ";
    echo $appointment['time'];?>
<br>
<?php
}
}
else {
    echo "There are no appointments today";

}?>

</body>
</html>
