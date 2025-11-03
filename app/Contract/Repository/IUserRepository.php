<?php

namespace App\Contract\Repository;

use App\Contract\Repository\IBaseRepository;
use App\Entity\User;

/**
 * @extends IBaseRepository<User>
 */
interface IUserRepository extends IBaseRepository
{
    public function findByUsername(string $username): ?User;
}
