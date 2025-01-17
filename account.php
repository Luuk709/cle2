<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: ./login.php');
    exit();
}

/** @var mysqli $db */
require_once 'includes/dbconnect.php';

$getAccInfo = "SELECT * FROM `users` INNER JOIN `reservations` ON reservations.user_id = users.id WHERE users.id = ' " . $_SESSION['id'] . " '";
$resultAccInfo = mysqli_query($db, $getAccInfo) or die('Error');

$errors = [];

if (isset($_POST['submit'])) {
    $image = $_FILES['image'];

    // Controleer of er een uploadfout is
    if ($image['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = "Image upload failed. Error code: " . $image['error'];
    } else {
        // Controleer het bestandstype
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if (!in_array($image['type'], $allowedTypes)) {
            $errors['image'] = "Only JPG, PNG, and GIF files are allowed.";
        }
    }

    if (empty($errors)) {
        // Stel de uploadmap en bestandsnaam in
        $uploadDir = 'uploads/';
        $fileName = time() . '_' . basename($image['name']);
        $filePath = $uploadDir . $fileName;

        // Verplaats het geüploade bestand naar de map
        if (move_uploaded_file($image['tmp_name'], $filePath)) {
            // Update de afbeelding in de database
            $query = "UPDATE users SET image = '$fileName' WHERE id = '" . $_SESSION['id'] . "'";
            $result = mysqli_query($db, $query);

            if ($result) {
                header('Location: account.php');
                exit();
            } else {
                $errors['db'] = "Error updating the user: " . mysqli_error($db);
            }
        } else {
            $errors['image'] = "Failed to save the uploaded image.";
        }
    }
}

// Ophalen van de gebruikersinformatie
$userId = $_SESSION['id'];
$query = "SELECT image FROM users WHERE id = '$userId'";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['image'] ? 'uploads/' . $row['image'] : ''; // Als er geen afbeelding is, stel dit in als leeg
} else {
    $imagePath = ''; // Geen afbeelding in de database
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
    <?php
// Controleer of er een afbeelding is
    if (empty($imagePath)): ?>
        <form action='' method='post' enctype='multipart/form-data'>
            <label for='image'>Upload Profile Picture:</label>
            <input type='file' name='image' id='image' accept='image/*'>
            <button type='submit' name='submit'>Upload</button>
        </form>
    <?php endif; ?>

    <?php if (!empty($imagePath)): ?>
        <img src='<?php echo htmlspecialchars($imagePath); ?>' alt='Profile Picture' style='width:150px; height:150px; object-fit:cover; border-radius:50%;'>
    <?php endif; ?>

    <p>Name:<?= $_SESSION['username'] ?></p>
    <!--<p>Email: --><?php //= $AccInfo[0]['email'] ?><!--</p>-->
    <a class="button is-danger" href="logout.php">
        Logout
    </a>

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
                    <a class="has-text-weight-normal has-text-black" href="deleteAppointment.php?id=<?=$results['id']?>">Delete Reservation</a>
                </th>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
<?php else:?>
<!--    <div class="">Je hebt nog geen reserveringen</div>-->
<?php endif;?>
</body>
</html>
