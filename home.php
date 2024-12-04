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
    <link rel="stylesheet" href="style.css">
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
            color: #fff;
        }

        .home-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #00f2fe;
        }

        p {
            margin: 15px 0;
        }

        p a {
            color: #4facfe;
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
        }

        p a:hover {
            background-color: #00f2fe;
            color: #fff;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Bem-vindo ao Almoxarifado</h1>
        <p><a href="produtos.php">Gerenciar Produtos</a></p>
        <p><a href="saidas.php">Controle de Saídas</a></p>
        <p><a href="logout.php">Sair</a></p>
    </div>
</body>
</html>
