<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
            exit;
        } else {
            $erro = "E-mail ou senha inválidos.";
        }
    } else {
        $erro = "E-mail inválido.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Almoxarifado</title>
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

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 350px;
            text-align: center;
        }

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

        p a {
            color: #2385c4;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .btn-cadastro {
            display: inline-block;
            background-color: #2385c4;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-cadastro:hover {
            background-color: #1b6b9d;
        }
    </style>

</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="cadastro.php" class="btn-cadastro">Cadastre-se</a></p>

    </div>
</body>
</html>
