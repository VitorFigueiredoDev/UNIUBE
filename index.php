<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>               
</head>
<body>
<form class="form" method="post" action="login.php" style="margin: 0 auto; margin-top: 170px;">
    CPF: <input type="text" name="cpf" id="cpf" value="<?php echo isset($_COOKIE['cpf']) ? $_COOKIE['cpf'] : ''; ?>"><br>
    SENHA: <input type="password" name="senha" id="senha" placeholder="1234" value="<?php echo isset($_COOKIE['senha']) ? $_COOKIE['senha'] : ''; ?>">
    <br>
    <input type="checkbox" name="lembrar" id="lembrar" <?php echo isset($_COOKIE['cpf']) ? 'checked' : ''; ?>> Lembrar Senha 
    <input type="submit" value="Entrar">
    
    <div class="error-message" style="<?php echo isset($_GET['error']) ? 'display:block;' : 'display:none;'; ?>">
        <?php if (isset($_GET['error'])) echo htmlspecialchars($_GET['error']); ?>
    </div>
</form>
</body>
</html>
