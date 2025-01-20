<?php
global $db;
include_once 'includes/dbconnect.php';
include_once 'src/sendMail.php';

// generate token to create a short term password.
$token = bin2hex(openssl_random_pseudo_bytes(16));

// send token to db with email
$sql = "INSERT into magiclinks (email, token, expire) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
$stmt = $db->prepare($sql);
$stmt->bind_param('ss', $_POST['email-magic-link'], $token);
$stmt->execute();

// send email with token
$info = new stdClass();
$to = $_POST['email-magic-link'];
$subject = "Your Magic Link";
$info->magicLink = "https://cle2.test/loginWithMagicLink?token=$token?email=$to";
$type = 'magicLink';
sendMail($to, $subject, $type, $info);

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

</body>
</html>
