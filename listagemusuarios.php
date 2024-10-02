<?php
include("valida.php");
include("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <span style="color: white;" class="texto">Olá <?=$_SESSION['nome'];?> seja bem vindo!</span>
            <a style="text-decoration: none; color: rgb(255, 255, 255);" href="sair.php" title="Sair"> <button class="bnt">Sair</button></a>
        </nav>
    </header>
    <div class="main-container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="principal.php">inicio</a></li>
                    <li><a href="cadastrarusuarios.php">Cadastro de usuários</a></li>
                </ul>
            </nav>
        </aside>


       
    </div>
</body>
</html>