<?php

namespace App\Service;

use App\Contract\Repository\IUserRepository;
use App\Contract\Service\IAuthService;
use App\Entity\User;

class AuthService implements IAuthService
{
  public function __construct(private readonly IUserRepository $userRepository) {
  }

  public function register(User $user): void {
    $existingUser = $this->userRepository->findByIdentifier([
      'username' => $user->username,
      'email' => $user->email,
    ]);
    if ($existingUser) {
      throw new \Exception('Username or email already exists.');
    }

    $user->password = password_hash($user->password, PASSWORD_BCRYPT);
    $this->userRepository->store($user);
  }

  public function login(User $user): void {
    $existingUser = $this->userRepository->findByIdentifier([
      'username' => $user->username,
      'email' => $user->username,
    ]);
    if (!$existingUser) {
      throw new \Exception('Invalid credentials.');
    }

    if ($user->password !== $existingUser->password
      && !password_verify($user->password, $existingUser->password)) {
      throw new \Exception('Invalid credentials.');
    }

    $_SESSION['user'] = $existingUser;
  }

  public function logout(): void {
    unset($_SESSION['user']);
  }
}
