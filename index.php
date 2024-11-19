<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

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
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Almoxarifado</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="cadastro.php">Não tem conta? Cadastre-se</a></p>
</body>
</html>
