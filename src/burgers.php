<?php
include 'includes/jwt-authentification.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $database = new mysqli("db", "burger_api_user", "root", "burger_api");
    mysqli_set_charset($database, "utf8mb4");
    $listeBurgers = $database->execute_query("SELECT * FROM burger")->fetch_all(MYSQLI_ASSOC);

    echo json_encode($listeBurgers);
}
