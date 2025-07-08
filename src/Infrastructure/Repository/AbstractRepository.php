<?php

namespace App\Infrastructure\Repository;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Entity\EntityInterface;

/**
 * @template T
 */
abstract class AbstractRepository
{
    public function __construct(protected readonly EntityManagerInterface $entityManager)
    {
    }

    protected function flush(): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param T $entity
     */
    protected function store(EntityInterface $entity): int
    {
        $this->entityManager->persist($entity);
        $this->flush();

        return $entity->getId();
    }
}
