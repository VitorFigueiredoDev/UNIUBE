<?php
include("conexao.php");
include("validacoes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $cpfanterior = $_POST["cpfanterior"];

    // Usar prepared statements para prevenir SQL injection
    $stmt = $conn->prepare("UPDATE usuarios SET cpf = ?, senha = ?, nome = ? WHERE cpf = ?");
    $stmt->bind_param("ssss", $cpf, $senha, $nome, $cpfanterior);

    if (!$stmt->execute()) {
        die("Erro ao atualizar: " . $stmt->error);
    }

    header("Location: cadastrarusuarios.php");
    exit();
}
?>
