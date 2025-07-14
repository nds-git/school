<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Lecture;

/**
 * @extends AbstractRepository<Lecture>
 */
class LectureRepository extends AbstractRepository
{
    public function create(Lecture $lecture): int
    {
        return $this->store($lecture);
    }
}
