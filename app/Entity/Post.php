<?php

namespace App\Entity;

use Core\Attribute\{Entity,Field};

#[Entity(tableName: 'posts')]
class Post
{
    #[Field(name: 'id', type: 'VARCHAR(24)', nullable: false, primary: true)]
    public string $id = '';

    #[Field(name: 'title', type: 'VARCHAR(255)', nullable: false)]
    public string $title;

    #[Field(name: 'content', type: 'TEXT', nullable: false)]
    public string $content;

    #[Field(name: 'created_at', type: 'DATETIME', nullable: false)]
    public string $createdAt;

    #[Field(name: 'updated_at', type: 'DATETIME', nullable: false)]
    public string $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime()->format('Y-m-d H:i:s');
        $this->updatedAt = new \DateTime()->format('Y-m-d H:i:s');
    }
}
