<?php

namespace App\Contract\Repository;

use App\Entity\Post;

/**
 * @extends IBaseRepository<Post>
 */
interface IPostRepository extends IBaseRepository
{
    /**
     * @return Post[]
     */
    public function byTitle(string $title): array;
}
