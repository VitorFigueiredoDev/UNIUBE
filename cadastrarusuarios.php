<?php
include("valida.php");
include("conexao.php");
include("validacoes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <span style="color: white;" class="texto">Olá <?= htmlspecialchars($_SESSION['nome']); ?>, seja bem-vindo!</span>
            <a style="text-decoration: none; color: rgb(255, 255, 255);" href="sair.php" title="Sair"><button class="bnt">Sair</button></a>
        </nav>
    </header>
    <div class="main-container">
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="principal.php">Início</a></li>
                    <li><a href="cadastrarusuarios.php">Cadastro de usuários</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <h1>Cadastrar Usuários</h1>

            <?php if (isset($_GET['erro'])): ?>
                <div style="color: red;">
                    <?php if ($_GET['erro'] == 'preencha_todos_os_campos') echo "Por favor, preencha todos os campos."; ?>
                </div>
            <?php endif; ?>

            <form class="form" method="post" action="cadastro.php" style="margin: 0 auto;">
                CPF: <input placeholder="000.000.000-00" type="text" name="cpf" id="cpf" required><br>
                SENHA: <input type="password" name="senha" id="senha" placeholder="1234" required><br>
                NOME: <input placeholder="JoseBonifacio" type="text" name="nome" id="nome" required><br>
                <input type="submit" value="Cadastrar">
            </form>
        </main>

        <aside>
        <main class="content">
            <h1>Listagem Usuários</h1>
            <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = $conn->query($sql);
            ?>
            <table class="tabela">
                <tr>
                    <td>CPF</td>
                    <td>Nome</td>
                    <td>Senha</td>
                    <td>Alterar</td>
                </tr>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                   <form method="post" action="alterarusuario.php">
                    <input type="hidden" name="cpfanterior" value="<?= htmlspecialchars($row['cpf']); ?>">
                    <td><input type="text" name="nome" value="<?= htmlspecialchars($row['nome']); ?>" required></td>
                    <td><input type="text" name="cpf" value="<?= htmlspecialchars($row['cpf']); ?>" required></td>
                    <td><input type="text" name="senha" value="<?= htmlspecialchars($row['senha']); ?>" required></td>
                    <td><input type="submit" value="Alterar"></td>
                   </form>
                </tr>
                <?php endwhile; ?>
            </table>
        </main>
        </aside>
    </div>
</body>
</html>
