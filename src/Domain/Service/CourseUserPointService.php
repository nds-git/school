<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\CourseUserPointRepository;
use App\Domain\Model\CourseUserPointModel;
use App\Domain\Entity\CourseUserPoint;

class CourseUserPointService
{
    public function __construct(private readonly CourseUserPointRepository $courseUserPointRepository)
    {
    }

    public function createCourseUserPoint(CourseUserPointModel $courseUserPointModel): CourseUserPoint
    {
        $courseUserPoint = new CourseUserPoint();
        $courseUserPoint->setUser($courseUserPointModel->user);
        $courseUserPoint->setCourse($courseUserPointModel->course);
        $courseUserPoint->setSumCoursePoint($courseUserPointModel->sumLecturePoint);
        $courseUserPoint->setIsVerified($courseUserPointModel->isVerified);

        $this->courseUserPointRepository->create($courseUserPoint);

        return $courseUserPoint;
    }
}
