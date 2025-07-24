<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\LectureUserPoint;

/**
 * @extends AbstractRepository<LectureUserPoint>
 */
class LectureUserPointRepository extends AbstractRepository
{
    public function create(LectureUserPoint $lectureUserPoint): int
    {
        return $this->store($lectureUserPoint);
    }
}
