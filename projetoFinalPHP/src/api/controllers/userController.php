<?php 
namespace App\api\Services;
use App\Api\Services\UserService;

class UserController{
    private UserService $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function register(array $data): bool{
        if(empty($data["name"]) ||
        empty($data["email"]) ||
        empty($data["password"])){
            return false;
        }
        return $this->userService->register(name: $data["name"], email:$data["email"], password: $data["password"]);
    }
        public function login(array $data): bool{
        if (empty($data["email"]) ||
        empty($data["password"])){
            return false;
        }
        return $this->userService->login(email:$data["email"], password: $data["password"]);
    }
}


?>