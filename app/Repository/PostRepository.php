<?php

namespace App\Repository;

use App\Contract\Repository\IPostRepository;
use App\Entity\Post;

/**
 * @extends BaseRepository<Post>
 */
class PostRepository extends BaseRepository implements IPostRepository
{
  protected string $entity = Post::class;

  public function allWithAuthor(): array {
    $columns = implode(', ', array_map(fn ($col) => "p.{$col['name']} AS {$col['property']}", $this->getColumns()));

    $stmt = $this->db->prepare("SELECT {$columns}, u.id AS author_id, u.username AS author_name
      FROM posts p
      JOIN users u ON p.author_id = u.id
      ORDER BY p.created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return array_map(function ($post) {
      $postEntity = new Post();
      $postEntity->id = $post['id'];
      $postEntity->title = $post['title'];
      $postEntity->content = $post['content'];
      $postEntity->createdAt = $post['createdAt'];
      $postEntity->updatedAt = $post['updatedAt'];
      $postEntity->author = [
        'id' => $post['author_id'],
        'username' => $post['author_name'],
      ];

      return $postEntity;
    }, $posts);
  }

  public function findWithAuthor(string $id): ?Post {
    $columns = implode(', ', array_map(fn ($col) => "p.{$col['name']} AS {$col['property']}", $this->getColumns()));

    $stmt = $this->db->prepare("SELECT {$columns}, u.id AS author_id, u.username AS author_name
      FROM posts p
      JOIN users u ON p.author_id = u.id
      WHERE p.id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $post = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (!$post) {
      return null;
    }

    $postEntity = new Post();
    $postEntity->id = $post['id'];
    $postEntity->title = $post['title'];
    $postEntity->content = $post['content'];
    $postEntity->createdAt = $post['createdAt'];
    $postEntity->updatedAt = $post['updatedAt'];
    $postEntity->author = [
      'id' => $post['author_id'],
      'username' => $post['author_name'],
    ];

    return $postEntity;
  }
}
