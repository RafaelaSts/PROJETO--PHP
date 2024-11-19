<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Registrar Saída
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Verificar quantidade disponível
    $query = $conn->prepare("SELECT quantidade FROM produtos WHERE id = ?");
    $query->bind_param("i", $produto_id);
    $query->execute();
    $result = $query->get_result();
    $produto = $result->fetch_assoc();

    if ($produto['quantidade'] >= $quantidade) {
        // Atualizar estoque
        $nova_quantidade = $produto['quantidade'] - $quantidade;
        $update_query = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?");
        $update_query->bind_param("ii", $nova_quantidade, $produto_id);
        $update_query->execute();

        // Registrar saída
        $saida_query = $conn->prepare("INSERT INTO saidas (produto_id, quantidade) VALUES (?, ?)");
        $saida_query->bind_param("ii", $produto_id, $quantidade);
        $saida_query->execute();

        $mensagem = "Saída registrada com sucesso!";
    } else {
        $erro = "Quantidade insuficiente no estoque.";
    }
}

// Listar Saídas
$saidas_result = $conn->query("
    SELECT s.id, p.nome AS produto, s.quantidade, s.data_saida
    FROM saidas s
    JOIN produtos p ON s.produto_id = p.id
");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Saídas - Almoxarifado</title>
</head>
<body>
    <h1>Controle de Saídas</h1>
    <?php if (!empty($mensagem)) echo "<p style='color:green;'>$mensagem</p>"; ?>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <!-- Formulário de Registro de Saída -->
    <h2>Registrar Saída</h2>
    <form method="post">
        <select name="produto_id" required>
            <option value="">Selecione um produto</option>
            <?php
            $produtos_result = $conn->query("SELECT id, nome FROM produtos");
            while ($produto = $produtos_result->fetch_assoc()): ?>
                <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?></option>
            <?php endwhile; ?>
        </select>
        <input type="number" name="quantidade" placeholder="Quantidade" min="1" required>
        <button type="submit">Registrar</button>
    </form>

    <!-- Lista de Saídas -->
    <h2>Histórico de Saídas</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($saida = $saidas_result->fetch_assoc()): ?>
                <tr>
                    <td><?= $saida['id'] ?></td>
                    <td><?= $saida['produto'] ?></td>
                    <td><?= $saida['quantidade'] ?></td>
                    <td><?= $saida['data_saida'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><a href="home.php">Voltar ao Dashboard</a></p>
</body>
</html>
