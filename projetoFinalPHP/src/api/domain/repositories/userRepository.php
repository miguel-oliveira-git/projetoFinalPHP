<?php 
namespace App\Domain\Repositoires;
use App\Domain\Entities\User;
interface UserRepository
{
    public function save(User $user):bool;
    public function findByEmail(string $email): ?User;
    
}
?>