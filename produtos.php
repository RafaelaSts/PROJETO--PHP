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
    <style>
        body {
            background: url('fundo.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 800px;
            margin-top: 30px;
        }

        h1, h2 {
            color: #00f2fe;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input, form textarea, form button {
            width: 100%;
            margin-top: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form button {
            background-color: #4facfe;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

        form button:hover {
            background-color: #00f2fe;
        }

        .form-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.9);
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            z-index: 100;
            margin-top: 30px;
            display: none;
        }

        .table-container {
            width: 90%;
            max-width: 800px;
            padding: 30px;
            margin-top: 150px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center; 
            margin-bottom: 30px; 
            margin-left: auto; 
            margin-right: auto; 
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #fff;
            text-align: left;
        }

        table th {
            background: #00f2fe;
            color: #fff;
        }

        table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }

        table tr:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        a {
            color: #4facfe;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .message.success {
            color: #4caf50;
        }

        .message.error {
            color: #f44336;
        }

        .back-link {
            margin-top: 20px;
            display: block;
            text-align: center;
        }

        .products-container {
            max-height: 400px; 
            overflow-y: auto;
            padding: 10px;
            width: 100%;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            border: none;
            background-color: #4facfe;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .button-container button:hover {
            background-color: #00f2fe;
        }

        .button-container .cancel-button {
            background-color: #f44336;
        }

        .button-container .cancel-button:hover {
            background-color: #ff5722;
        }

        .add-product-btn {
            margin-top: 20px;
            display: block;
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #00f2fe;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .add-product-btn:hover {
            background-color: #4facfe;
        }

        .back-dashboard-btn {
            margin-top: 20px;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #f44336;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-left: auto;
            margin-right: auto;
            width: 200px; 
        }

        .back-dashboard-btn:hover {
            background-color: #ff5722;
        }

    </style>
</head>
<body>
    <div class="table-container">
        <h2>Produtos em Estoque</h2>

        <!-- Exibe mensagens de sucesso ou erro -->
        <?php if (!empty($mensagem)) echo "<p class='message success'>$mensagem</p>"; ?>
        <?php if (!empty($erro)) echo "<p class='message error'>$erro</p>"; ?>

        <!-- Botão para adicionar novo produto -->
        <button class="add-product-btn" onclick="mostrarFormulario()">Adicionar Novo Produto</button>

        <!-- Lista de produtos -->
        <div class="products-container">
            <table>
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
        </div>
    </div>

    <!-- Formulário para adicionar produto -->
    <div class="form-container" id="formContainer">
        <h2>Adicionar Produto</h2>
        <form method="post">
            <input type="hidden" name="adicionar_produto" value="1">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>

            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" required>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <div class="button-container">
                <button type="submit">Adicionar Produto</button>
                <button type="button" class="cancel-button" onclick="cancelarFormulario()">Cancelar</button>
            </div>
        </form>
    </div>

    <!-- Botão para voltar ao dashboard -->
    <button class="back-dashboard-btn" onclick="window.location.href = 'home.php';">Voltar</button>

    <script>
        function mostrarFormulario() {
            document.getElementById('formContainer').style.display = 'block';
        }

        function cancelarFormulario() {
            document.getElementById('formContainer').style.display = 'none';
        }
    </script>
</body>
</html>
