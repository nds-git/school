<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\LectureRepository;
use App\Domain\Entity\Lecture;
use App\Domain\Entity\Course;

class LectureService
{
    public function __construct(private readonly LectureRepository $lectureRepository)
    {
    }

    public function postLecture(Course $course, string $titleLecture, int $isActive): Lecture
    {
        $lecture = new Lecture();
        $lecture->setCourse($course);
        $lecture->setTitleLecture($titleLecture);
        $lecture->setCreatedAt();
        $lecture->setUpdatedAt();
        $lecture->setIsActive($isActive);
        $course->addLecture($lecture);

        $this->lectureRepository->create($lecture);

        return $lecture;
    }


    public function findLectureById(int $id): ?Lecture
    {
        return $this->lectureRepository->find($id);
    }
}
