<?php

namespace App\Service;

use App\Contract\Repository\IUserRepository;
use App\Contract\Service\IAuthService;

class AuthService implements IAuthService
{
    public function __construct(private readonly IUserRepository $userRepository)
    {
    }

    public function register(array $data): bool
    {
        return true;
    }

    public function login(array $data): ?object
    {
        $user = $this->userRepository->findByUsername($data['username']);
        if (!$user) {
            throw new \Exception('Invalid credentials.');
        }

        if ($data['password'] !== $user->password && !password_verify($data['password'], $user->password)) {
            throw new \Exception('Invalid credentials.');
        }

        $_SESSION['user'] = $user;
        return $user;
    }



    public function logout(): bool
    {
        unset($_SESSION['user']);
        return true;
    }
}
