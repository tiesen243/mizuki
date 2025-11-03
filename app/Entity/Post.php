<?php

namespace App\Entity;

use Core\Abstract\Entity;
use Core\Attribute\{Field, Table};

#[Table(name: 'posts', primaryKey: 'id')]
class Post extends Entity
{
  #[Field(name: 'id')]
  public string $id = '';

  #[Field(name: 'title')]
  public string $title;

  #[Field(name: 'content')]
  public string $content;

  #[Field(name: 'author_id')]
  public string $authorId;

  #[Field(name: 'created_at')]
  public string $createdAt;

  #[Field(name: 'updated_at')]
  public string $updatedAt;

  public function __construct() {
    $this->createdAt = new \DateTime()->format('Y-m-d H:i:s');
    $this->updatedAt = new \DateTime()->format('Y-m-d H:i:s');
  }

  public function validate(array $fields): array {
    $errors = [];

    if (in_array('title', $fields, true) || empty($fields)) {
      if (empty($this->title)) {
        $errors['title'] = 'Title is required.';
      } elseif (strlen($this->title) < 3 || strlen($this->title) > 100) {
        $errors['title'] = 'Title must be between 3 and 100 characters.';
      }
    }

    if (in_array('content', $fields, true) || empty($fields)) {
      if (empty($this->content)) {
        $errors['content'] = 'Content is required.';
      } elseif (strlen($this->content) < 10) {
        $errors['content'] = 'Content must be at least 10 characters.';
      }
    }

    return $errors;
  }
}
