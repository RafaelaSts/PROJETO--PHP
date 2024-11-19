<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Processa a adição de produtos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_produto'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $nome, $descricao, $quantidade, $preco);

    if ($stmt->execute()) {
        $mensagem = "Produto adicionado com sucesso!";
    } else {
        $erro = "Erro ao adicionar o produto.";
    }
}

// Processa a exclusão de produtos
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $mensagem = "Produto excluído com sucesso!";
    } else {
        $erro = "Erro ao excluir o produto.";
    }
}

// Lista todos os produtos
$result = $conn->query("SELECT * FROM produtos");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
</head>
<body>
    <h1>Gerenciamento de Produtos</h1>
    <!-- Exibe mensagens de sucesso ou erro -->
    <?php if (!empty($mensagem)) echo "<p style='color:green;'>$mensagem</p>"; ?>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <!-- Formulário para adicionar produto -->
    <h2>Adicionar Produto</h2>
    <form method="post">
        <input type="hidden" name="adicionar_produto" value="1">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" required><br>

        <label for="preco">Preço (R$):</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br>

        <button type="submit">Adicionar Produto</button>
    </form>

    <!-- Lista de produtos -->
    <h2>Produtos em Estoque</h2>
    <table border ="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($produto = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id']) ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="produtos.php?excluir=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <p><a href="home.php">Voltar ao Dashboard</a></p>
</body>
</html>
