<?php
//FAZER O CODIGO AQUI
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body class="page-center">
    <div class="container-login-register">
        <h2>Login de Usuário</h2>
        <?php if ($message): ?>
            <p class="message <?= $success ? 'success' : '' ?>">
                <?= htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label>Email:</label>
            <input name="email" type="email" required>

            <label>Senha:</label>
            <input name="password" type="password" required>

            <button type="submit">Logar</button>
        </form>
        <p style="text-align:center;margin-top:10px;">
            Não tem conta? <a href="register.php">Cadastre-se aqui!</a>
        </p>
    </div>
</body>

</html>
 
