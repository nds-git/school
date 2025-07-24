<?php

namespace App\Domain\DTO;

readonly class AddLectureUserPointDTO
{
    public function __construct(
        public int $userId,
        public int $lectureId,
    ) {
    }
}