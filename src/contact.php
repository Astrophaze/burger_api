<?php
include 'includes/jwt-authentification.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    mysqli_set_charset($database, "utf8mb4");
    $stmt = $database->prepare("INSERT INTO contact (nom, email, message)
    VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $_POST['nom'], $_POST['email'], $_POST['message']);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'ok']);
    } else {
        echo json_encode(['success' => 'error']);
    }
}
