<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\CourseUserPoint;

/**
 * @extends AbstractRepository<CourseUserPoint>
 */
class CourseUserPointRepository extends AbstractRepository
{
    public function create(CourseUserPoint $courseUserPoint): int
    {
        return $this->store($courseUserPoint);
    }
}
