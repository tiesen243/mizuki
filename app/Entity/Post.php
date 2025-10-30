<?php

namespace App\Entity;

use Core\Attribute\{Entity,Field};

#[Entity(tableName: 'posts')]
class Post
{
    #[Field(name: 'id', type: 'VARCHAR(24)', primary: true)]
    public string $id;

    #[Field(name: 'title', type: 'VARCHAR(255)')]
    public string $title;

    #[Field(name: 'content', type: 'TEXT')]
    public string $content;

    #[Field(name: 'created_at', type: 'DATETIME')]
    public mixed $createdAt;

    #[Field(name: 'updated_at', type: 'DATETIME')]
    public mixed $updatedAt;


    public function __construct()
    {
        $this->id = createId();
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    public function toArray(): array
    {
        return [
          'id' => $this->id,
          'title' => $this->title,
          'content' => $this->content,
          'createdAt' => $this->createdAt,
          'updatedAt' => $this->updatedAt,
        ];

    }
}
