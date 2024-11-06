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

// Prepara a consulta SQL para evitar SQL Injection
$sql = "INSERT INTO usuarios (cpf, nome, senha) VALUES (?, ?, ?)";

// Prepara o statement
$stmt = $conn->prepare($sql);

// Verifica se a preparação do statement foi bem-sucedida
if ($stmt === false) {
    // Se falhar, exibe um erro
    die("Erro na preparação do statement: " . $conn->error);
}

// Faz o binding dos parâmetros e executa o statement
$stmt->bind_param("sss", $cpf, $nome, $senha);

// Executa a consulta
if ($stmt->execute()) {
    // Redireciona para a página com mensagem de sucesso
    header("Location: cadastrarusuarios.php?sucesso=cadastro_realizado");
} else {
    // Se a execução falhar, redireciona com erro
    header("Location: cadastrarusuarios.php?erro=erro_ao_cadastrar");
}

// Fecha o statement
$stmt->close();
exit();
?>
