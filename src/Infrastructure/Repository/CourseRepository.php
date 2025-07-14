<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Course;

/**
 * @extends AbstractRepository<Course>
 */
class CourseRepository extends AbstractRepository
{
    public function create(Course $course): int
    {
        return $this->store($course);
    }
}
