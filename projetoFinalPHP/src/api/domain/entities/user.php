<?php 
namespace App\Domain\Entities;

class User{
    public int $id;
    public string $name;
    public string $email;
    public string $password_hash;
    public string $role = "USER";
    public function __construct($name, $email, $password_hash){
        $this->name= $name;
        $this->email= $email;
        $this->password_hash= $password_hash;
    }
}

?>