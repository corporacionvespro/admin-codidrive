<?php
$host = '161.132.54.172';
$dbname = 'codidrive';
$username = 'root';
$password = 'vespro$2024&';

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function redirect($url, $permanent = false)
{
    if (!headers_sent()) {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
    }
    exit();
}