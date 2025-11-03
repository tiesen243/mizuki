<?php

namespace App\Repository;

use App\Contract\Repository\IUserRepository;
use App\Entity\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    protected string $entity = User::class;

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $data = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->entity);
        return $data[0] ?? null;
    }
}
