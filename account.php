<?php
session_start();
if(!isset($_SESSION['id'])) {
    header('location: ./login.php');
}


/** @var mysqli $db */
require_once 'includes/dbconnect.php';
$getAccInfo = "SELECT * FROM `users` INNER JOIN `reservations` ON reservations.user_id = users.id WHERE users.id = ' " . $_SESSION['id'] . " '";
$resultAccInfo = mysqli_query($db, $getAccInfo)
or die('Error ');
//$accInfo = [];
//
//// Alle resultaten ophalen
//while($row = mysqli_fetch_assoc($resultAccInfo))
//{
//    $accInfo[] = $row;
//}
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
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation" style="background-color: #C4C4C4">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="./index.php">
               Home
            </a>
            <?php

            if ($_SESSION['admin'] != 1){

} elseif  (isset($_SESSION['admin'])) {
                    echo '<a class="navbar-item" href="overview.php">
                Overview
            </a>';
                    echo '  <a class="navbar-item" href="overviewClient.php">
                Clients
            </a>';
                }


?>
            <a class="navbar-item" href="logout.php">
                Logout
            </a>

        </div>
        <div class="navbar-end" >
            <a class="navbar-item" href="index.php">
                <img  src="./fotos/logo_CutOrDye.png" alt="logo"/>
            </a>
        </div>
    </div>
</nav>
<?php if ($resultAccInfo) :?>
    <h1 class="is-size-2">Account information</h1>
    <p>Name:<?= $_SESSION['username'] ?></p>
    <!--<p>Email: --><?php //= $AccInfo[0]['email'] ?><!--</p>-->
<div id="aa" style="display: none">
        <p>Are you sure you want to delete this?</p>
    <button class="button" onclick="" id="deleteButton">Confirm</button>
    <button onclick="show()" class="button">Cancel</button>
    </div>
    <h1 class="is-size-2">Reservation information</h1>
    <table class="table is-striped is-fullwidth is-bordered">
        <thead>
        <tr class="has-text-weight-bold">
            <th>
                Date
            </th>
            <th>
                Time
            </th>
            <th>
                Change
            </th>
            <th>
                Delete
            </th>
        </tr>
        </thead>
        <tbody>
        <?php while ($results = mysqli_fetch_assoc($resultAccInfo)):?>
            <tr>
                <th class="has-text-weight-normal"> <?= htmlspecialchars($results['date']) ?></th>
                <th class="has-text-weight-normal"> <?= htmlspecialchars($results['time']) ?></th>
                <th>
                    <a class="has-text-weight-normal has-text-black" href="editAppointment.php?id=<?=$results['id']?>">Change Reservation</a>
                </th>
                <th>
                    <a onclick="show('<?= htmlspecialchars($results['id']) ?>')" class="has-text-weight-normal has-text-black">Delete Reservation</a>
                </th>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
<?php else:?>
<!--    <div class="">Je hebt nog geen reserveringen</div>-->
<?php endif;?>
<script defer>
    function deleteAppointment(id) {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                }
            };

            xhttp.open("GET", `deleteAppointment.php?q=${id}`, true);
            xhttp.send();

    }

    function show(id){
        var stats =  document.getElementById("aa").style.display;
        let deleteButton = document.getElementById('deleteButton');
        deleteButton.onclick = function () {deleteAppointment(id)}
        // console.log(id)

        if (stats == "none"){
            document.getElementById("aa").style.display = "inline-block";
        } else {
            document.getElementById("aa").style.display = "none";
        }
    }

</script>
</body>
</html>
