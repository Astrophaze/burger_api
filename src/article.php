<?php
include 'includes/jwt-authentification.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    mysqli_set_charset($database, "utf8mb4");
    $article = $database->execute_query("SELECT * FROM article WHERE id = ?", array($_GET['id_article']));

    echo json_encode($article->fetch_assoc());
}
