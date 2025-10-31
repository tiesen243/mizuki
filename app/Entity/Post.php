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
    public \DateTime|string $createdAt;

    #[Field(name: 'updated_at', type: 'DATETIME', nullable: false)]
    public \DateTime|string $updatedAt;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function toArray(): array
    {
        if (!($this->createdAt instanceof \DateTime)) {
            $this->createdAt = new \DateTime($this->createdAt);
        }

        if (!($this->updatedAt instanceof \DateTime)) {
            $this->updatedAt = new \DateTime($this->updatedAt);
        }

        return [
          'id' => $this->id,
          'title' => $this->title,
          'content' => $this->content,
          'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
          'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
        ];
    }
}
