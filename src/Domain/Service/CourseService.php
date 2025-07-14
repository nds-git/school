<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\CourseRepository;
use App\Domain\Entity\Course;

class CourseService
{
    public function __construct(private readonly CourseRepository $courseRepository)
    {
    }

    public function postCourse(string $titleCourse, int $isActive): Course
    {
        $course = new Course();
        $course->setTitleCourse($titleCourse);
        $course->setCreatedAt();
        $course->setUpdatedAt();
        $course->setIsActive($isActive);
        $this->courseRepository->create($course);

        return $course;
    }

    public function refresh(Course $course): void
    {
        $this->courseRepository->refresh($course);
    }
}
