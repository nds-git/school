<?php

namespace App\Domain\Service;

use App\Domain\Entity\Course;

class CourseBuilderService
{
    public function __construct(
        private readonly CourseService $courseService,
        private readonly LectureService $lectureService,
        private readonly ExerciseService $exerciseService,
    ) {
    }

    /**
     * @param string $CourseTitle
     * @param int $isActive
     * @param array $lectureTitles
     * @return Course
     */
    public function createLectureWithCourse(string $CourseTitle, int $isActive, array $lectureTitles): Course
    {
        $course = $this->courseService->postCourse($CourseTitle, $isActive);
        foreach ($lectureTitles as $title) {
            $this->lectureService->postLecture($course, $title, $isActive);
        }

        return $course;
    }


    /**
     * @param string $CourseTitle
     * @param int $isActive
     * @param array $lectureTitles
     * @return Course
     */
    public function createCourse(string $CourseTitle, int $isActive, array $lectureTitles): Course
    {
        $course = $this->courseService->postCourse($CourseTitle, $isActive);
        foreach ($lectureTitles as $title) {
            $this->lectureService->postLecture($course, $title, $isActive);
        }

        return $course;
    }

    /**
     * @param string $CourseTitle
     * @param int $isActive
     * @param array $lectureTitles
     * @return Course
     */
    public function createCourseWithLectureAndExercises(string $CourseTitle, int $isActive, array $lectureTitles): Course
    {
        $course = $this->courseService->postCourse($CourseTitle, $isActive);
        foreach ($lectureTitles as $title) {
            $lecture = $this->lectureService->postLecture($course, $title[0], $isActive);
            foreach ($title[1] as $exercise) {
                $this->exerciseService->postExercise($lecture, $exercise, $isActive);
            }
        }

        return $course;
    }
}