<?php
require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$mongoUri = $_ENV['MONGO_URI'] ?? null;
$dbName = $_ENV['DB_NAME'] ?? null;
$secretKey = $_ENV['SECRET_KEY'] ?? null;

if (!$mongoUri || !$dbName) {
    die(json_encode(["error" => "Environment variables not set correctly."]));
}

try {
    $client = new MongoDB\Client($mongoUri);
    $db = $client->selectDatabase($dbName);
} catch (Exception $e) {
    die(json_encode(["error" => "Connection Failed: " . $e->getMessage()]));
}
