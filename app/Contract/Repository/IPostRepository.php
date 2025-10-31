<?php

namespace App\Contract\Repository;

use App\Entity\Post;

/**
 * @extends IBaseRepository<Post>
 */
interface IPostRepository extends IBaseRepository
{
    /** @return array<Post> */
    public function findByTitle(string $title): array;
}
