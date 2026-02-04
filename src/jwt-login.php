<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Le token doit être long d'au moins 30 caractères
$secret = "tw8e3GT9ZcttMz93tOlE7SUqE2gIlH6bDLGQnAuJEp4ncfnUSL";

$payload = [
    'iss' => 'mon-angular-app', // Qui appelle
    'aud' => 'burger_api', // Qui reçoit
    'iat' => time(),
    'exp' => time() + (3600 * 24 * 180) // Expiration au bout de 6 mois
];

$jwt = JWT::encode($payload, $secret, 'HS256');

echo json_encode(["token" => $jwt]);