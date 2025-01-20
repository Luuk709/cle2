<?php
global $db;
require_once 'includes/dbconnect.php';

$token = $_GET['token'];
$email = $_GET['email'];

// check if token is in db
$sql = "SELECT * FROM magiclinks WHERE token = ? AND email = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('ss', $token, $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $expire = $row['expire'];
    $current = date('Y-m-d H:i:s');

    if ($expire > $current) {
        // login user
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['user'] = $row;
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
    } else {
        header('Location: login.php');
    }
} else {
    header('Location: login.php');
}