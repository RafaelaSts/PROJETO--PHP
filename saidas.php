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

    $query = $conn->prepare("SELECT quantidade FROM produtos WHERE id = ?");
    $query->bind_param("i", $produto_id);
    $query->execute();
    $result = $query->get_result();
    $produto = $result->fetch_assoc();

    if ($produto['quantidade'] >= $quantidade) {
        $nova_quantidade = $produto['quantidade'] - $quantidade;
        $update_query = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?");
        $update_query->bind_param("ii", $nova_quantidade, $produto_id);
        $update_query->execute();

        $saida_query = $conn->prepare("INSERT INTO saidas (produto_id, quantidade) VALUES (?, ?)");
        $saida_query->bind_param("ii", $produto_id, $quantidade);
        $saida_query->execute();

        $mensagem = "Saída registrada com sucesso!";
    } else {
        $erro = "Quantidade insuficiente no estoque.";
    }
}

$saidas_result = $conn->query("
    SELECT s.id, p.nome AS produto, s.quantidade, s.data_saida
    FROM saidas s
    JOIN produtos p ON s.produto_id = p.id
");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Saídas</title>
    <style>
        body {
            background: url('fundo.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: black;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 700px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        select, input[type="number"] {
            width: 90%;
            max-width: 300px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4facfe;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 90%;
            max-width: 300px;
        }

        button[type="submit"]:hover {
            background-color: #00f2fe;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #4facfe;
            color: white;
        }

        .mensagem {
            margin: 10px 0;
            color: green;
        }

        .erro {
            color: red;
        }

        a {
            color: #4facfe;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Controle de Saídas</h1>
        <div class="mensagem">
            <?php if (!empty($mensagem)) echo "<p>$mensagem</p>"; ?>
            <?php if (!empty($erro)) echo "<p class='erro'>$erro</p>"; ?>
        </div>

        <!-- Formulário de Registro de Saída -->
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
        <table>
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
    </div>
</body>
</html>
