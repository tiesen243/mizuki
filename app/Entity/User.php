<?php

namespace App\Entity;

use Core\Abstract\Entity;
use Core\Attribute\{Field,Table};

#[Table(name: 'users', primaryKey: 'id')]
class User extends Entity
{
    #[Field(name: 'id')]
    public string $id = '';

    #[Field(name: 'username')]
    public string $username;

    #[Field(name: 'email')]
    public string $email;

    #[Field(name: 'password')]
    public string $password;

    #[Field(name: 'created_at')]
    public string $createdAt;

    #[Field(name: 'updated_at')]
    public string $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime()->format('Y-m-d H:i:s');
        $this->updatedAt = new \DateTime()->format('Y-m-d H:i:s');
    }

    public function validate(array $fields): array
    {
        $errors = [];

        if (in_array('identifier', $fields) || empty($fields)) {
            if (empty($this->username) && empty($this->email)) {
                $errors['identifier'] = 'Username or email is required.';
            }
        }

        if (in_array('username', $fields) || empty($fields)) {
            if (empty($this->username)) {
                $errors['username'] = 'Username is required.';
            } elseif (strlen($this->username) < 3 || strlen($this->username) > 20) {
                $errors['username'] = 'Username must be between 3 and 20 characters.';
            }
        }

        if (in_array('email', $fields) || empty($fields)) {
            if (empty($this->email)) {
                $errors['email'] = 'Email is required.';
            } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format.';
            }
        }

        if (in_array('password', $fields) || empty($fields)) {
            if (empty($this->password)) {
                $errors['password'] = 'Password is required.';
            } elseif (strlen($this->password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters.';
            }
        }

        return $errors;
    }
}
