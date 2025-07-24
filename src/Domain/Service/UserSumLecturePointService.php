<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\LectureUserPointRepository;
use App\Domain\Entity\LectureUserPoint;
use App\Domain\Entity\User;

class UserSumLecturePointService
{
    public function __construct(
        private readonly LectureUserPointRepository $lectureUserPointRepository,
    ) {
    }

    public function calculateUserLecturePoint(User $user, int $lectureId): void
    {

        $this->lectureUserPointRepository->create($lectureId);
    }
}
