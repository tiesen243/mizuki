<?php

namespace App\Contract\Service;

use App\Entity\User;

interface IAuthService
{
    /**
     * @param array{username: string, password: string, email: string} $data
     * @return bool
     */
    public function register(array $data): bool;

    /**
     * @param array{username: string, password: string} $data
     * @return User|null
     */
    public function login(array $data): ?object;

    /**
     * @return bool
     */
    public function logout(): bool;
}
