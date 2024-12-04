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
                background: url('fundonovo.jpg') no-repeat center center fixed;
                background-size: cover;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                color: #333;
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
                color: black; /* Azulchat */
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
                background-color: #2385c4; /* Azulchat */
                color: #fff;
                border: none;
                cursor: pointer;
                font-size: 16px;
                margin-top: 15px;
            }

            form button:hover {
                background-color: #1b6b9d; /* Tom mais escuro para hover */
            }

            .form-container {
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(255, 255, 255, 0.9); /* Fundo branco com opacidade */
                color: #333; /* Texto padrão */
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
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                display: flex;
                flex-direction: column;
                align-items: center; 
                margin-bottom: 30px; 
                margin-left: auto; 
                margin-right: auto; 
            }

            .products-container {
                max-height: 300px;
                overflow-y: auto;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #fff; /* Cor de fundo branco */
                padding: 10px;
                width: 100%;
            }

            table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
                background: white;
            }

            table th, table td {
                padding: 10px;
                border: 1px solid #333;
                text-align: left;
            }

            table th {
                background: #2385c4; /* Azulchat */
                color: #fff;
            }

            table tr:nth-child(even) {
                background: #f2f2f2;
            }

            table tr:hover {
                background: #e9e9e9;
            }

            a {
                color: #2385c4; /* Azulchat */
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
                color: #28a745;
            }

            .message.error {
                color: #dc3545;
            }

            .add-product-btn, .back-dashboard-btn {
                background-color: #2385c4; /* Azulchat */
                color: white;
                border: none;
                cursor: pointer;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 16px;
                text-align: center;
                display: block;
                margin: 20px auto;
            }

            .add-product-btn:hover, .back-dashboard-btn:hover {
                background-color: #1b6b9d; /* Tom mais escuro para hover */
            }

            #pesquisar {
                width: 100%;
                padding: 10px;
                margin-top: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }
        </style>

</head>
<body>
    <div class="table-container">
        <h2>Produtos em Estoque</h2>

        <!-- Exibe mensagens de sucesso ou erro -->
        <?php if (!empty($mensagem)) echo "<p class='message success'>$mensagem</p>"; ?>
        <?php if (!empty($erro)) echo "<p class='message error'>$erro</p>"; ?>

        <!-- Barra de pesquisa -->
        <div>
            <label for="pesquisar">Pesquisar Produtos:</label>
            <input type="text" id="pesquisar" oninput="filtrarProdutos()" placeholder="Digite para pesquisar um produto">
        </div>

        <!-- Botão para mostrar o formulário de adicionar produto -->
        <button class="add-product-btn" onclick="mostrarFormulario()">Adicionar Produto</button>

        <!-- Lista de produtos -->
        <div class="products-container" id="productsContainer" style="display: block;">
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

            <button type="submit">Adicionar Produto</button>
            <button type="button" onclick="cancelarFormulario()">Cancelar</button>
        </form>
    </div>

    <button class="back-dashboard-btn" onclick="window.location.href='home.php'">Voltar</button>

    <script>
        function mostrarFormulario() {
            document.getElementById('formContainer').style.display = 'block';
        }

        function cancelarFormulario() {
            document.getElementById('formContainer').style.display = 'none';
        }

        function filtrarProdutos() {
            const input = document.getElementById('pesquisar');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('.products-container table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) { // Começa em 1 para ignorar o cabeçalho
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        }
    </script>
</body>
</html>
