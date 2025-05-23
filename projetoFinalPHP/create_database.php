<?php 
// transforma um arquivo que está sendo chamado em um array associativo.
$env= parse_ini_file(filename: ".env");

try{
    $pdo= new PDO(
        dsn: "mysql:host={$env['DB_HOST']};charset={$env['DB_CHARSET']}",
        username: $env['DB_USER'],
        password: $env['DB_PASS']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbName= $env['DB_NAME'];
    $pdo->exec(statement:"CREATE DATABASE IF NOT EXISTS `$dbName`COLLATE utf8mb4_general_ci");

    echo "Banco de dados criado com sucesso";

    $pdo->exec(statement: "USE `$dbName`");
    $createTableSQL= "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        role ENUM('USER', 'ADMIN') DEFAULT 'USER',
        create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;
";
    $pdo->exec($createTableSQL);
    echo"<br>Tabela criada com sucesso";


    $inserAdm1= "INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `create_at`) VALUES (NULL, 'sasasa', 'sasasa', 'saasas', 'ADMIN', current_timestamp())";

    $pdo->exec($inserAdm1);
    echo"<br> Usuário ADM criado com sucesso";
    
    $inserUser1= "INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `create_at`) VALUES (NULL, 'JAO', 'JAO@JAO', '123', 'USER', current_timestamp())";
    $pdo->exec($inserUser1);
    echo"<br> Usuário USER criado com sucesso";
    

}catch(PDOException $e){
    exit("Erro ao criar banco ou tabela: " .$e->getMessage());
}

// composer dump-autoload

?>




