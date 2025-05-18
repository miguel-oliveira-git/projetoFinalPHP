<?php 
namespace App\Infrastructure\Persistence\MySQL;

use PDO;
use App\Domain\Entities\User;
use App\Domain\Repositoires\UserRepository;
$env= parse_ini_file(filename: ".env");

class MysqlUserRepository implements UserRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo= $pdo;
    }
    public function save(User $user): bool {
        $stmt = $this->pdo->prepare(query: "INSERT INTO users (name, email, password_hash, role) VALUES (?,?,?,?)");
        return $stmt->execute(params:[
            $user->name,
            $user->email,
            $user->password_hash,
            $user->role
        ]);
    }
    public function findByEmail(string $email): ?User {
        $stmt = $this->pdo->prepare(query:"SELECT * FROM users WHERE email = ?");
        $data = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        return $data != false ? new User($data["name"], email:$data ["email"], password_hash: $data ["password_hash"]): null;
    }
}

?>