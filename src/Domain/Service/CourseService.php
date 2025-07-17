<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\CourseRepository;
use App\Domain\Model\CreateCourseModel;
use App\Domain\Entity\Course;

class CourseService
{
    public function __construct(private readonly CourseRepository $courseRepository)
    {
    }

    public function createCourse(CreateCourseModel $createCourseModel): Course
    {
        $course = new Course();
        $course->setTitleCourse($createCourseModel->titleCourse);
        $course->setCreatedAt();
        $course->setUpdatedAt();
        $course->setIsActive($createCourseModel->isActive);
        $this->courseRepository->create($course);

        return $course;
    }

    public function refresh(Course $course): void
    {
        $this->courseRepository->refresh($course);
    }
}
