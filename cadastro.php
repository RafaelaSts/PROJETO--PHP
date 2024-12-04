<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $query->bind_param("sss", $nome, $email, $senha);

    if ($query->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Almoxarifado</title>
    <style>
        body {
            background: url('fundonovo.jpg') no-repeat center center fixed;
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
            max-width: 350px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            max-width: 300px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #2385c4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 90%;
            max-width: 300px;
        }

        button[type="submit"]:hover {
            background-color: #1b6b9d;
        }

        p {
            color: red;
        }

        a {
            color: #2385c4;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .voltar-button {
            background-color: #2385c4; /* Azulchat */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .voltar-button:hover {
            background-color: #1b6b9d; /* Tom mais escuro para hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
        <form method="post">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <p>
            <a href="index.php"><button type="button" class="voltar-button">Voltar ao Login</button></a>
        </p>

    </div>
</body>
</html>
