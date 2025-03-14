<?php
require '../config/config.php';
require '../api/middleware.php';

header("Content-Type: application/json");

$usersCollection = $db->users;

// **Ambil ID user dari token**
$userId = authenticate();

// **Ambil Data User**
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user = $usersCollection->findOne(["_id" => new MongoDB\BSON\ObjectId($userId)]);
    if (!$user) {
        echo json_encode(["error" => "User tidak ditemukan"]);
        exit;
    }

    echo json_encode([
        "nama" => $user['nama'],
        "email" => $user['email'],
        "created_at" => $user['created_at']
    ]);
    exit;
}
