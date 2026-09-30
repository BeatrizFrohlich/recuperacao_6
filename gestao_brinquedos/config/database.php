<?php
$host = 'localhost';
$db   = 'gestao_brinquedos';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (Exception $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}