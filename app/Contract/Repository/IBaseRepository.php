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
     */
    public function create(object $entity): void;

    /**
     * @param TEntity $entity
     */
    public function update(string $id, object $entity): void;

    /**
     * @param string $id
     */
    public function delete(string $id): void;
}
