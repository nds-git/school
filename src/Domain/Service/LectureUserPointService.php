<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\LectureUserPointRepository;
use App\Infrastructure\Repository\CourseUserPointRepository;
use App\Domain\Model\LectureUserPointModel;
use App\Domain\Entity\LectureUserPoint;

class LectureUserPointService
{
    public function __construct(
        private readonly LectureUserPointRepository $lectureUserPointRepository,
    ) {
    }

    public function createLectureUserPoint(LectureUserPointModel $lectureUserPointModel): LectureUserPoint
    {
        $lectureUserPoint = new LectureUserPoint();
        $lectureUserPoint->setUser($lectureUserPointModel->user);
        $lectureUserPoint->setLecture($lectureUserPointModel->lecture);
        $lectureUserPoint->setSumLecturePoint($lectureUserPointModel->sumLecturePoint);
        $lectureUserPoint->setIsVerified($lectureUserPointModel->isVerified);

        $this->lectureUserPointRepository->create($lectureUserPoint);

        return $lectureUserPoint;
    }


    public function getSumLecturePoint(int $userId, array $courseId): array
    {
        return $this->lectureUserPointRepository->getSumLecturePoint($userId, $courseId);
    }
}
