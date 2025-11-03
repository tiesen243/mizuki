<?php

namespace App\Contract\Repository;

use App\Entity\User;

/**
 * @extends IBaseRepository<User>
 */
interface IUserRepository extends IBaseRepository
{
  /**
   * @param array{username: string, email: string} $identifier
   */
  public function findByIdentifier(array $identifier): ?User;
}
