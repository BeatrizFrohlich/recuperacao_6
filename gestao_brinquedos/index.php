<?php
include 'config/database.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM brinquedos ORDER BY id DESC");
    $stmt->execute();
    $brinquedos = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Erro ao buscar brinquedos: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Brinquedos</title>
</head>
<body>

    <h1>Sistema de Gestão de Brinquedos</h1>

    <?php 
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'cadastrado') {
            echo '<p style="color: green;">Brinquedo cadastrado com sucesso!</p>';
        }
        if ($_GET['msg'] == 'editado') {
            echo '<p style="color: green;">Brinquedo atualizado com sucesso!</p>';
        }
        if ($_GET['msg'] == 'excluido') {
            echo '<p style="color: green;">Brinquedo excluído com sucesso!</p>';
        }
    }
    ?>

    <a href="cadastrar.php">Cadastrar Novo Brinquedo</a>
    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Faixa Etária</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (!empty($brinquedos)) {
                foreach ($brinquedos as $b) { 
                ?>
                    <tr>
                        <td><?php echo $b['id']; ?></td>
                        <td><?php echo $b['nome']; ?></td>
                        <td><?php echo $b['categoria']; ?></td>
                        <td><?php echo $b['faixa_etaria']; ?></td>
                        <td>R$ <?php echo $b['preco']; ?></td>
                        <td><?php echo $b['quantidade']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $b['id']; ?>">Editar</a> | 
                            <a href="excluir.php?id=<?php echo $b['id']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php 
                } 
            } else {
            ?>
                <tr>
                    <td colspan="7">Nenhum brinquedo cadastrado.</td>
                </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>

</body>
</html>