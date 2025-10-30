<?php

namespace App\Repository;

use App\Contract\Repository\IPostRepository;
use App\Entity\Post;

/**
 * @extends BaseRepository<Post>
 */
class PostRepository extends BaseRepository implements IPostRepository
{
    public function __construct()
    {
        $this->entity = new Post();
        parent::__construct();
    }
}
