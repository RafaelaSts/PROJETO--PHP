<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM produtos WHERE id = ?");
$query->bind_param("i", $id);

if ($query->execute()) {
    header("Location: produtos.php?msg=Produto excluído com sucesso!");
    exit;
} else {
    header("Location: produtos.php?msg=Erro ao excluir o produto.");
    exit;
}
?>
