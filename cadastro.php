<?php 
include("conexao.php");

// Receber dados do formulário
$cpf = $_POST["cpf"];
$senha = $_POST["senha"];
$nome = $_POST["nome"];

// Verificando se todos os campos foram preenchidos
if (empty($cpf) || empty($senha) || empty($nome)) {
    // Redireciona de volta com uma mensagem de erro
    header("Location: cadastrarusuarios.php?erro=preencha_todos_os_campos");
    exit();
}

// Caso todos os campos estejam preenchidos, insira os dados
$sql = "INSERT INTO usuarios (cpf, nome, senha) VALUES ('$cpf', '$nome', '$senha')";

$resultado = $conn->query($sql);
header("Location: cadastrarusuarios.php");
exit();
?>
