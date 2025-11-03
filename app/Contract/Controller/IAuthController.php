<?php

declare(strict_types=1);

namespace App\Contract\Controller;

use App\Contract\Repository\IUserRepository;
use Core\Http\Response;

interface IAuthController
{
  public function register(IUserRepository $userRepo): Response;

  public function login(IUserRepository $userRepo): Response;

  public function logout(): Response;
}
