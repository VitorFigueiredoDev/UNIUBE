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

        <main class="content">
            <h1>Cadastrar Usuarios</h1>

            <?php if (isset($_GET['erro'])): ?>
                <div style="color: red;">
                    <?php
                    if ($_GET['erro'] == 'preencha_todos_os_campos') {
                        echo "Por favor, preencha todos os campos.";
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form class="form" method="post" action="cadastro.php" style="margin: 0 auto;">
                CPF: <input placeholder="000.000.000-00" type="text" name="cpf" id="cpf"><br>
                SENHA: <input type="password" name="senha" id="senha" placeholder="1234"><br>
                NOME: <input placeholder="JoseBonifacio" type="text" name="nome" id="nome"><br>
                <input type="submit" value="Cadastrar">
            </form>
        </main>

        <aside>
        <main class="content">
            <h1>Listagem Usuarios</h1>
            <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = $conn->query($sql);
            ?>
            <table class="tabela">
                <tr>
                    <td>cpf</td>
                    <td>nome</td>
                    <td>senha</td>
                    <td>alterar</td>
                </tr>
                <?php
                while ($row = $resultado->fetch_assoc()) {  
                ?>
                <tr>
                   <form method="post" action="alterarusuario.php">
                    <input type="hidden" name="cpfanterior" value="<?=$row['cpf'];?>">
                    <td>
                       <input type="text" name="nome" value="<?=$row['nome'];?>">
                    </td>
                    <td>
                     <input type="text" name="cpf" value="<?=$row['cpf'];?>">
                    </td>
                    <td>
                     <input type="text" name="senha" value="<?=$row['senha'];?>">
                    </td>
                    <td>
                     <input type="submit" value="alterar">
                    </td>
                   </form>
                </tr>
                <?php } ?>
            </table>
        </main>
        </aside>
    </div>
</body>
</html>
