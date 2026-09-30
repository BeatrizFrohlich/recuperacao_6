<?php
require_once 'config/database.php';

$erro = '';

$id = $_GET['id'];

if (empty($id)) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['atualizar'])) {

    $nome         = $_POST['nome'];
    $categoria    = $_POST['categoria'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $preco        = $_POST['preco'];
    $quantidade   = $_POST['quantidade'];

    if (empty($nome) || empty($categoria) || empty($faixa_etaria) || empty($preco) || empty($quantidade)) {
        $erro = "Por favor, preencha todos os campos!";
    } else {
        try {
            $sql = "UPDATE brinquedos 
                    SET nome = :nome, categoria = :categoria, faixa_etaria = :faixa_etaria, preco = :preco, quantidade = :quantidade 
                    WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':faixa_etaria', $faixa_etaria);
            $stmt->bindValue(':preco', $preco);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':id', $id);

            $stmt->execute();

            header('Location: index.php?msg=editado');
            exit();

        } catch (PDOException $e) {
            $erro = "Erro ao atualizar no banco: " . $e->getMessage();
        }
    }
}

try {
    $sql = "SELECT * FROM brinquedos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    
    $brinquedo = $stmt->fetch();

    if (!$brinquedo) {
        header('Location: index.php');
        exit();
    }
} catch (PDOException $e) {
    die("Erro ao buscar dados do brinquedo: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
</head>
<body>

    <div class="form-container">
        <h2>Editar Brinquedo #<?php echo $id; ?></h2>

        <?php if ($erro != ''): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="editar.php?id=<?php echo $id; ?>" method="POST">
            <label for="nome">Nome do Brinquedo:</label>
            <input type="text" id="nome" name="nome" required value="<?php echo $brinquedo['nome']; ?>">

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" required value="<?php echo $brinquedo['categoria']; ?>">

            <label for="faixa_etaria">Faixa Etária:</label>
            <input type="text" id="faixa_etaria" name="faixa_etaria" required value="<?php echo $brinquedo['faixa_etaria']; ?>">

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required value="<?php echo $brinquedo['preco']; ?>">

            <label for="quantidade">Quantidade em Estoque:</label>
            <input type="number" id="quantidade" name="quantidade" min="0" required value="<?php echo $brinquedo['quantidade']; ?>">

            <button type="submit" name="atualizar" class="btn">Atualizar</button>
        </form>

        <a href="index.php" class="btn-back">⬅ Voltar</a>
    </div>

</body>
</html>