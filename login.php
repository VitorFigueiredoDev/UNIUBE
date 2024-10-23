<?php
include("conexao.php");
include("validacoes.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    
    $sql = "SELECT nome FROM usuarios WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $cpf, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row = $result->fetch_assoc();
        if (isset($row) && $row["nome"] != '') {
            session_start();
            $_SESSION["cpf"] = $cpf;
            $_SESSION["senha"] = $senha;
            $_SESSION["nome"] = $row["nome"];
            
            // Verifica se o usuário optou por lembrar
            if (isset($_POST['lembrar'])) {
                setcookie('cpf', $cpf, time() + (30 * 24 * 60 * 60), "/");
                setcookie('senha', $senha, time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie('cpf', '', time() - 3600, "/");
                setcookie('senha', '', time() - 3600, "/");
            }

            // Redirecionar para a página principal
            header("Location: principal.php");
            exit();
        } else {
            // Redirecionar de volta para a página de login com uma mensagem de erro
            header("Location: index.php?error=Senha incorreta. Tente novamente.");
            exit();
        }
    }
}
?>
