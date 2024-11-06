<?php 
include("conexao.php");

// Verifica se o CPF foi enviado
if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    // Verifica se o CPF não está vazio
    if (!empty($cpf)) {
        // Prepara a consulta SQL para deletar o usuário
        $sql = "DELETE FROM usuarios WHERE cpf = ?";

        // Prepara a consulta
        $stmt = $conn->prepare($sql);
        
        // Verifica se a preparação foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação do statement: " . $conn->error);
        }

        // Faz o binding do parâmetro CPF
        $stmt->bind_param("s", $cpf);

        // Executa a consulta
        if ($stmt->execute()) {
            // Se a exclusão for bem-sucedida, redireciona para a página de cadastro com mensagem de sucesso
            header("Location: cadastrarusuarios.php?sucesso=usuario_deletado");
        } else {
            // Se ocorrer um erro ao excluir, redireciona com mensagem de erro
            header("Location: cadastrarusuarios.php?erro=erro_ao_deletar");
        }

        // Fecha o statement
        $stmt->close();
    }
}
?>
