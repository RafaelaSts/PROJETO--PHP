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
<html>
<head>
    <title>Cadastro - Almoxarifado</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Cadastro</h1>
    <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
