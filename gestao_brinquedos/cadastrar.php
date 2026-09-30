<?php
require_once 'config/database.php';

$erro = '';

if (isset($_POST['salvar'])) {
    
    $nome         = $_POST['nome'];
    $categoria    = $_POST['categoria'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $preco        = $_POST['preco'];
    $quantidade   = $_POST['quantidade'];

    if (empty($nome) || empty($categoria) || empty($faixa_etaria) || empty($preco) || empty($quantidade)) {
        $erro = "Por favor, preencha todos os campos!";
    } else {
        try {
            $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade) 
                    VALUES (:nome, :categoria, :faixa_etaria, :preco, :quantidade)";
            
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':categoria', $categoria);
            $stmt->bindValue(':faixa_etaria', $faixa_etaria);
            $stmt->bindValue(':preco', $preco);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->execute();

            header('Location: index.php?msg=cadastrado');
            exit();

        } catch (PDOException $e) {
            $erro = "Erro ao salvar no banco: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Brinquedo</title>
</head>
<body>

    <div class="form-container">
        <h2>Novo Brinquedo</h2>

        <?php if ($erro != ''): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="cadastrar.php" method="POST">
            <label for="nome">Nome do Brinquedo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" placeholder="Ex: Jogos, Bonecos" required>

            <label for="faixa_etaria">Faixa Etária:</label>
            <input type="text" id="faixa_etaria" name="faixa_etaria" placeholder="Ex: 3-5 anos, +8 anos" required>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0" required>

            <label for="quantidade">Quantidade em Estoque:</label>
            <input type="number" id="quantidade" name="quantidade" min="0" required>

            <button type="submit" name="salvar" class="btn">Salvar</button>
        </form>

        <a href="index.php" class="btn-back">⬅ Voltar</a>
    </div>

</body>
</html>