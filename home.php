<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Almoxarifado</title>
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
            color: black; /* Azulchat */
            text-align: center;
            margin-bottom: 20px;
        }

        .home-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 90%;
            max-width: 350px;
        }

        p {
            margin: 15px 0;
        }

        p a {
            color: #fff; /* Texto branco */
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: 10px;
            background: #2385c4; /* Azulchat */
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        p a:hover {
            background-color: #1b6b9d; /* Tom mais escuro para hover */
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Bem-vindo a PharmaLog</h1>
        <p><a href="produtos.php">Gerenciar Produtos</a></p>
        <p><a href="saidas.php">Controle de Saídas</a></p>
        <p><a href="logout.php">Sair</a></p>
    </div>
</body>
</html>
