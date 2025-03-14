<?php
require '../config/config.php';
require '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Content-Type: application/json");

// Tangkap request
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';
$secret_key = $_ENV['SECRET_KEY'] ?? 'default_secret_key';

// Koleksi MongoDB
$usersCollection = $db->users;

// **Registrasi User**
if ($method === 'POST' && $action === 'register') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['nama']) || empty($data['email']) || empty($data['password'])) {
        echo json_encode(["error" => "Semua field harus diisi"]);
        exit;
    }

    // Cek apakah email sudah terdaftar
    $existingUser = $usersCollection->findOne(["email" => $data['email']]);
    if ($existingUser) {
        echo json_encode(["error" => "Email sudah terdaftar"]);
        exit;
    }

    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $insertResult = $usersCollection->insertOne([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'password' => $hashedPassword,
        'role' => 'user',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    echo json_encode(["message" => "Registrasi berhasil! Silakan login.", "user_id" => (string) $insertResult->getInsertedId()]);
    exit;
}

// **Login User**
if ($method === 'POST' && $action === 'login') {
    $data = json_decode(file_get_contents("php://input"), true);


    if (empty($data['email']) || empty($data['password'])) {
        echo json_encode(["error" => "Email dan password wajib diisi"]);
        exit;
    }

    $user = $usersCollection->findOne(["email" => $data['email']]);

    if ($user && password_verify($data['password'], $user['password'])) {
        // Buat JWT Token
        $payload = [
            "iat" => time(),
            "exp" => time() + (60 * 60), // 1 jam
            "sub" => (string) $user['_id']
        ];

        $token = JWT::encode($payload, $secret_key, 'HS256');

        echo json_encode([
            "message" => "Login berhasil",
            "token" => $token
        ]);
    } else {
        echo json_encode(["error" => "Email atau password salah"]);
    }
    exit;
}
