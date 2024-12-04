<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'almoxarifado_farmacia';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
