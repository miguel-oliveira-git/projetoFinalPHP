<?php
require __DIR__."/../vendor/autoload.php";
use App\API\Controllers\UserController;
use App\API\Services\UserService;
use App\Infrastructure\Persistence\MySQL\MysqlUserRepository;
$env= parse_ini_file(filename: ".env");

$pdo= new PDO(
    dsn: "mysql:host={$env['DB_HOST']};charset={$env['DB_CHARSET']}",
    username: $env['DB_USER'],
    password: $env['DB_PASS']
    );

$userRepo= new MysqlUserRepository(pdo: $pdo);
$userService= new UserService ($userRepo);
$userController= new UserController (userService: $userService);

$message='';
$sucess=false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    $sucess=$userController->register(data:$_POST);
    $message=$sucess ? "Cadrastrado Com Sucesso" : "falha ao cadastrar";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body class="page-center">
    <div class="container-login-register">
        <h2>Cadastro de Usuário</h2>
        <?php if ($message): ?>
            <p class="message <?= $success ? 'success' : '' ?>">
                <?= htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label>Nome:</label>
            <input name="name" type="text" required>

            <label>Email:</label>
            <input name="email" type="email" required>

            <label>Senha:</label>
            <input name="password" type="password" required>

            <button type="submit">Cadastrar</button>
        </form>
        <p style="text-align:center;margin-top:10px;">
            Já tem conta? <a href="login.php">Faça login aqui!</a>
        </p>
    </div>
</body>

</html>

 