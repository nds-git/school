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
}
