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
        parent::__construct(new Post());
    }

    /** @return array<Post> */
    public function findByTitle(string $title): array
    {
        $columns = $this->getSelectColumns();
        $stmt = $this->db->prepare("SELECT {$columns} FROM {$this->tableName} WHERE title LIKE :title");
        $stmt->execute([':title' => "%$title%"]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_class($this->entity));
    }
}
