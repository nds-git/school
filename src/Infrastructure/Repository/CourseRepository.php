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

    public function find(int $courseId): ?Course
    {
        $repository = $this->entityManager->getRepository(Course::class);
        /** @var Course|null $course */
        $course = $repository->find($courseId);

        return $course;
    }

    /**
     * @return Course[]
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(Course::class)->findAll();
    }
}
