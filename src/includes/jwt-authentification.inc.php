<?php
// Headers CORS
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
// Traiter la preflight request en PREMIER
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
http_response_code(200);
exit();
}
// inclusion des packages installés avec Composeer
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
// Le token en lui-même, en dur certes mais côté back
$secret = 'tw8e3GT9ZcttMz93tOlE7SUqE2gIlH6bDLGQnAuJEp4ncfnUSL';
// Si on n'a pas de header "Authorization" alors on coupe court et on renvoie une 401
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
http_response_code(401);
exit('Token manquant');
}
// On supprime le mot-clé "Bearer" qui vient avec le Token
$token = str_replace('Bearer ', '', $headers['Authorization']);
// Et on essaie de décoder le JWT pour retomber sur notre clé secrète.
try {
$decoded = JWT::decode($token, new Key($secret, 'HS256'));
// Si la cible du JWT décodé n'est pas la bonne, c'est que la clé n'était pas bonne, on renvoie une erreur
if ($decoded->aud !== 'burger_api') {
throw new Exception('Audience invalide');
}
} catch (Exception $e) {
http_response_code(401);
exit('Token invalide');
}
