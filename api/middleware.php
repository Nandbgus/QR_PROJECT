<?php
require '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Middleware untuk validasi token JWT
function authenticate()
{
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "Akses ditolak, token tidak ditemukan"]);
        exit;
    }

    $authHeader = $headers['Authorization'];
    $token = str_replace('Bearer ', '', $authHeader);

    try {
        $decoded = JWT::decode($token, new Key($_ENV['SECRET_KEY'], 'HS256'));
        return $decoded->sub; // ID pengguna
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(["error" => "Token tidak valid"]);
        exit;
    }
}
