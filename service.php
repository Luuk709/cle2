<?php

/** @var mysqli $db */
require_once 'includes/dbconnect.php';

$query = "";

try {


    // Get the input data
    $input = json_decode(file_get_contents('php://input'), true);

    if (isset($input['picture_service'])) {
        $pictureName = $input['picture_service'];

        // Insert into the database
        $stmt = $query->prepare("INSERT INTO service (picture_service) VALUES (:picture_service)");
        $stmt->bindParam(':picture_service', $pictureName, PDO::PARAM_STR);
        $stmt->execute();

        // Respond with success
        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Invalid input');
    }
} catch (Exception $e) {
    // Handle errors
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
