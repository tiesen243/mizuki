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
        parent::__construct();
    }

    /**
     * @return Post[]
     */
    public function byTitle(string $title): array
    {
        $columns = $this->getColumns();
        $columnList = implode(', ', array_map(fn ($col) => "{$col['name']} AS {$col['property']}", $columns));
        $stmt = $this->db->prepare("SELECT {$columnList} FROM {$this->tableName} WHERE title LIKE :title");
        $stmt->execute(['title' => "%{$title}%"]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->entity);
    }
}
