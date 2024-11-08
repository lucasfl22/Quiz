<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (isset($_GET['erro'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['erro']) . '</p>';
        }
        ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="login">Usuário ou E-mail:</label>
                <input type="text" id="login" name="login" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <button type="submit" class="btn-login">Entrar</button>
        </form>
        <div class="navigation">
            <a href="../index.php" class="btn-nav">Voltar ao Site</a>
            <a href="form_cadastro.php" class="btn-nav">Cadastrar-se</a>
        </div>
    </div>
</body>
</html>

