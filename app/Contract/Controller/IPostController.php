<?php

declare(strict_types=1);

namespace App\Contract\Controller;

use App\Contract\Repository\IPostRepository;
use Core\Http\Response;

interface IPostController
{
  public function index(IPostRepository $postRepo): Response;

  public function show(string $id, IPostRepository $postRepo): Response;

  public function create(IPostRepository $postRepo): Response;

  public function edit(string $id, IPostRepository $postRepo): Response;

  public function delete(string $id, IPostRepository $postRepo): Response;
}
