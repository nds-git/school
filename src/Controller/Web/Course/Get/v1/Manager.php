<?php

namespace App\Controller\Web\Course\Get\v1;

use App\Domain\Service\CourseService;
use App\Domain\Entity\Course;

class Manager
{
    public function __construct(private readonly CourseService $courseService)
    {
    }

    public function findCourseById(int $courseId): ?Course
    {
        return $this->courseService->findCourseById($courseId);
    }

    /**
     * @return Course[]
     */
    public function getAllCourses(): array
    {
        return $this->courseService->findAll();
    }
}
