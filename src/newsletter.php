<?php
include 'includes/jwt-authentification.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    mysqli_set_charset($database, "utf8mb4");
    $stmt = $database->prepare("INSERT INTO contact (email)
    VALUES(?)");
    $stmt->bind_param("s", $_POST['email']);

    if ($stmt->execute()) {
        echo json_encode(['success' => 'ok']);
    } else {
        echo json_encode(['success' => 'error']);
    }
}
