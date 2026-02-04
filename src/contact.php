<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/jwt-authentification.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    mysqli_set_charset($database, "utf8mb4");
    $stmt = $database->prepare("INSERT INTO contact (nom, email, message)
    VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $_POST['nom'], $_POST['email'], $_POST['message']);

    if($stmt->execute()) {
        echo json_encode(['success' => true]);
        require_once 'vendor/autoload.php';

        $mailer = new PHPMailer();
        $mailer->CharSet = 'UTF-8';
        $mailer->Encoding = 'base64';

        $mailer->Host = 'localhost';
        $mailer->Port = 8025;
        $mailer->SMTPAuth = false;
        $mailer->SMTPSecure = '';

        $mailer->setFrom($_POST['email'], $_POST['nom']);
        $mailer->addAddress('noreply@demande.fr');

        $mailer->Subject = "Nouveau message de " . $_POST['nom'] . " via le formulaire de contact";
        $mailer->Body = $_POST['nom'] . ' vous a écrit ce message : ' . $_POST['message'];

        $mailer->send();
        } else {
        echo json_encode(['success' => false]);
    }
}
