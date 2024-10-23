<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<script>
    function validarCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');

        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
            return false;
        }

        let soma = 0;
        let resto;

        for (let i = 1; i <= 9; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.substring(9, 10))) {
            return false;
        }

        soma = 0;
        for (let i = 1; i <= 10; i++) {
            soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.substring(10, 11))) {
            return false;
        }

        return true;  
    }

    function validarFormulario(event) {
        const cpf = document.forms["loginform"]["cpf"].value;
        const senha = document.forms["loginform"]["senha"].value;

        if (cpf === "" || !validarCPF(cpf)) {
            alert("Por favor, insira um CPF válido.");
            event.preventDefault();
            return false;
        }

        if (senha === "") {
            alert("Por favor, insira uma senha.");
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
<body>
<form class="form" name="loginform" method="post" action="login.php" onsubmit="return validarFormulario(event)" style="margin: 0 auto; margin-top: 170px;">
    CPF: <input type="text" name="cpf" id="cpf" value="<?php echo isset($_COOKIE['cpf']) ? htmlspecialchars($_COOKIE['cpf']) : ''; ?>" required><br>
    SENHA: <input type="password" name="senha" id="senha" placeholder="1234" value="<?php echo isset($_COOKIE['senha']) ? htmlspecialchars($_COOKIE['senha']) : ''; ?>" required>
    <br>
    <input type="checkbox" name="lembrar" id="lembrar" <?php echo isset($_COOKIE['cpf']) ? 'checked' : ''; ?>> Lembrar Senha 
    <input type="submit" value="Entrar">
    
    <div class="error-message" style="<?php echo isset($_GET['error']) ? 'display:block;' : 'display:none;'; ?>">
        <?php if (isset($_GET['error'])) echo htmlspecialchars($_GET['error']); ?>
    </div>
</form>
</body>
</html>
