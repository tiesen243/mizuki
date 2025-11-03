<?php

namespace App\Repository;

use App\Contract\Repository\IUserRepository;
use App\Entity\User;

class UserRepository extends BaseRepository implements IUserRepository
{
  protected string $entity = User::class;

  public function findByIdentifier(array $identifier): ?User {
    $stmt = $this->db->prepare('SELECT * FROM users
            WHERE username = :username OR email = :email
            LIMIT 1');
    $stmt->execute([
      ':username' => $identifier['username'],
      ':email' => $identifier['email'],
    ]);
    $data = $stmt->fetchObject($this->entity);

    return $data ?: null;
  }
}
