<?php

namespace App\Entity;

use Core\Attribute\Field;

class Post
{
    public static string $tableName = 'posts';
    public static string $primaryKey = 'id';

    #[Field(name: 'id')]
    public string $id = '';

    #[Field(name: 'title')]
    public string $title;

    #[Field(name: 'content')]
    public string $content;

    #[Field(name: 'created_at')]
    public string $createdAt;

    #[Field(name: 'updated_at')]
    public string $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime()->format('Y-m-d H:i:s');
        $this->updatedAt = new \DateTime()->format('Y-m-d H:i:s');
    }

    public function validate(): array
    {
        $errors = [];

        if (strlen($this->title) < 4 || strlen($this->title) > 255) {
            $errors['title'] = 'Title must be between 4 and 255 characters long.';
        }

        if (strlen($this->content) < 10) {
            $errors['content'] = 'Content must be at least 10 characters long.';
        }

        return $errors;
    }
}
