<?php

declare(strict_types=1);

namespace App\Contract\Controller;

use Core\Http\Response;

interface IHomeController
{
  public function index(): Response;
}
