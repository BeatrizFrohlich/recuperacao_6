<?php
$host = 'localhost';
$db   = 'gestao_brinquedos';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}