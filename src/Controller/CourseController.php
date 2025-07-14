<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Service\CourseBuilderService;

class CourseController extends AbstractController
{
    public function __construct(
        private readonly CourseBuilderService $courseBuilderService,
    )
    {
    }

    public function createCourseWithLecture(): Response
    {
        $course = $this->courseBuilderService->createLectureWithCourse(
            'Docker', 0,
            ['Docker Images', 'How to create our first php program']
        );

        return $this->json($course->toArray());
    }

    public function createCourseWithLectureAndExercises(): Response
    {
        $course = $this->courseBuilderService->createCourseWithLectureAndExercises(
            'PHP', 0, [
                0 => [
                'PHP function',
                    ['Задание function 1', 'Задание function 2', 'Задание function 3'],
                ],
                1 => [
                'PHP variables',
                ['Задание variables 1', 'Задание variables 2', 'Задание variables 3'],
            ],
            ],
        );

        return $this->json($course->toArray());
    }
}