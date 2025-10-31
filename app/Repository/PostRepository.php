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
        $this->entity = Post::class;
        $this->tableName = Post::$tableName;
        $this->primaryKey = Post::$primaryKey;
        parent::__construct();
    }
}
