<?php

declare(strict_types=1);

namespace App\Contract\Repository;

use App\Entity\Post;

/**
 * @extends IBaseRepository<Post>
 */
interface IPostRepository extends IBaseRepository
{
  public function allWithAuthor(): array;

  public function findWithAuthor(string $id): ?Post;
}
