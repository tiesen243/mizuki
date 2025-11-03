<?php

namespace App\Contract\Repository;

use App\Contract\Repository\IBaseRepository;
use App\Entity\User;

/**
 * @extends IBaseRepository<User>
 */
interface IUserRepository extends IBaseRepository
{
    /**
     * @param array{username: string, email: string} $identifier
     * @return User|null
     */
    public function findByIdentifier(array $identifier): ?User;
}
