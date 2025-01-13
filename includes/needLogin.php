<?php

if (isset($_SESSION['id']) && $_SESSION['id'] !== '') {
    echo "";
} else {
    header('location: login.php');
}