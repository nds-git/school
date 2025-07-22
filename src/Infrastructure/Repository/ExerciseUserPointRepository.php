<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\ExerciseUserPoint;

/**
 * @extends AbstractRepository<ExerciseUserPoint>
 */
class ExerciseUserPointRepository extends AbstractRepository
{
    public function create(ExerciseUserPoint $exerciseUserPoint): int
    {
        return $this->store($exerciseUserPoint);
    }
}
