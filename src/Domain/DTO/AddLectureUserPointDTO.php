<?php

namespace App\Domain\DTO;

class AddLectureUserPointDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $lectureId,
        public readonly int $sumLecturePoint,
    ) {
    }
}