<?php
require_once 'config/database.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = $_GET['id'];

    try {
        $sql = "DELETE FROM brinquedos WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':id', $id);
        
        $stmt->execute();
        
        header('Location: index.php?msg=excluido');
        exit();

    } catch (PDOException $e) {
        die("Erro ao excluir brinquedo: " . $e->getMessage());
    }

} else {
    header('Location: index.php');
    exit();
}