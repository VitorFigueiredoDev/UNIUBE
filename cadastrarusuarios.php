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
    <script>
        function validarFormulario() {
            const cpf = document.getElementById('cpf').value;
            const senha = document.getElementById('senha').value;

            // Validação do CPF: apenas números e exatamente 11 dígitos
            const cpfRegex = /^\d{11}$/;
            if (!cpfRegex.test(cpf)) {
                alert("CPF inválido. Certifique-se de que o CPF tenha exatamente 11 dígitos numéricos.");
                return false;
            }

            // Validação da senha: pelo menos 1 número, 1 letra maiúscula, 1 letra minúscula e no mínimo 8 caracteres
            const senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
            if (!senhaRegex.test(senha)) {
                alert("Senha inválida. A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma letra minúscula e um número.");
                return false;
            }

            return true; // Se todas as validações passarem, o formulário será enviado
        }

        // Função para alternar a visibilidade da senha
        function mostrarSenha() {
            const senhaInput = document.getElementById('senha');
            const tipo = senhaInput.type === "password" ? "text" : "password";
            senhaInput.type = tipo;
        }
    </script>

</head>
<body>
    <header>
        <nav class="navbar">
            <span style="color: white;" class="texto">Olá <?= htmlspecialchars($_SESSION['nome']); ?>, seja bem-vindo!</span>
            <a href="sair.php" title="Sair" style="text-decoration: none; color: white;"><button class="bnt">Sair</button></a>
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

        <h1>Cadastro de Usuários</h1>

<form class="form-cadastro" method="post" action="cadastro.php" onsubmit="return validarFormulario()">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" placeholder="José Bonifácio" required>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" placeholder="00000000000" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" placeholder="Senha" required>

    <label>
        <input type="checkbox" onclick="mostrarSenha()"> Mostrar senha
    </label>

    <input type="submit" value="Cadastrar">
</form>



            <h1>Listagem de Usuários</h1>

            <?php
            // Consultando os usuários no banco de dados
            $sql = "SELECT * FROM usuarios";
            $resultado = $conn->query($sql);
            ?>

            <table class="tabela-usuarios">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nome']); ?></td>
                            <td><?= htmlspecialchars($row['cpf']); ?></td>
                            <td><?= htmlspecialchars($row['senha']); ?></td>
                            <td class="acoes">
                                <form method="post" action="alterarusuario.php" class="form-alterar" style="display: inline;">
                                    <input type="hidden" name="cpfanterior" value="<?= htmlspecialchars($row['cpf']); ?>">
                                    <button type="submit">Alterar</button>
                                </form>
                                <form method="post" action="deletarusuario.php" class="form-deletar" style="display: inline;">
                                    <input type="hidden" name="cpf" value="<?= htmlspecialchars($row['cpf']); ?>">
                                    <button type="submit" class="deletar">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            
        </main>
    </div>
</body>
</html>
