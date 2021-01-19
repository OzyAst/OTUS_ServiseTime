<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Services\Users\DTOs\RegisterDTO;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function register(RegisterDTO $registerDTO): ?User;
    public function updateEmail(User $user, string $email): ?User;

    /**
     * Вернет владельца бизнеса по id
     * @param int $business_id
     * @return User|null
     */
    public function findOwnerBusiness(int $business_id): ?User;
}
