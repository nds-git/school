<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Exercise;

/**
 * @extends AbstractRepository<Exercise>
 */
class ExerciseRepository extends AbstractRepository
{
    public function create(Exercise $exercise): int
    {
        return $this->store($exercise);
    }

    public function find(int $exerciseId): ?Exercise
    {
        $repository = $this->entityManager->getRepository(Exercise::class);
        /** @var Exercise|null $exercise */
        $exercise = $repository->find($exerciseId);

        return $exercise;
    }
}
