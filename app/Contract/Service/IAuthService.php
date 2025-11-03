<?php

namespace App\Contract\Service;

use App\Entity\User;

interface IAuthService
{
  public function register(User $user): void;

  public function login(User $user): void;

  public function logout(): void;
}
