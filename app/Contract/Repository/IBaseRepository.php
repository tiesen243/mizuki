<?php

declare(strict_types=1);

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
   * @return TEntity|null
   */
  public function find(string $id): ?object;

  /**
   * @param TEntity $entity
   */
  public function store(object $entity): bool;

  public function delete(string $id): bool;
}
