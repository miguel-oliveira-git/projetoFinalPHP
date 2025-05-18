<?php 
namespace APP\API\Services;

use APP\Domain\Entities\User;
use APP\Domain\Repositoires\UserRepository;
use Composer\Autoload\ClassLoader;

class UserService{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository= $userRepository;
    }
    public function register($name, $email, $password): bool{
        $hash = password_hash(password: $password, algo:PASSWORD_DEFAULT);

        $user = new User (name: $name, email: $email,password_hash: $hash);
        return $this->userRepository->save(user:$user);
    }
    public function login($email, $password): bool{
        $user= $this->userRepository->findByEmail(email:$email);
        return $user && password_verify (password:$password, hash: $user->password_hash);
    }
}

?>