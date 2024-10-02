<?php 
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST["cpf"];
    $senha = $_POST["senha"];
    $sql = "SELECT nome FROM usuarios WHERE cpf = '$cpf' AND senha='$senha'";

    if(!$resultado = $conn->query($sql)){
        die("Erro");
    }

    $row = $resultado->fetch_assoc();

    if(isset($row) && $row["nome"] != ''){
        session_start();
        $_SESSION["cpf"] = $cpf;
        $_SESSION["senha"] = $senha;
        $_SESSION["nome"] = $row["nome"];
        
        // Verifica se o usuário optou por lembrar
        if(isset($_POST['lembrar'])){
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
        // Redirect back to the login page with an error message
        header("Location: index.php?error=Senha incorreta. Tente novamente.");
        exit();
    }
}
?>
