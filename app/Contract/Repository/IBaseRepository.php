<?php

namespace App\Contract\Repository;

/**
 * @template TEntity of object
 */
interface IBaseRepository
{
    /**
     * @return TEntity[]
     */
    public function all(): array;

    /**
     * @param string $id
     * @return TEntity|null
     */
    public function find(string $id): ?object;

    /**
     * @param TEntity $entity
     * @return bool
     */
    public function store(object $entity): bool;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}
