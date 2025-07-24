<?php

namespace App\Domain\Model;

use App\Domain\Entity\Lecture;
use App\Domain\Entity\User;

readonly class LectureUserPointModel
{
    public function __construct(
        public User $user,
        public Lecture $lecture,
        public ?int $sumLecturePoint,
        public int $isVerified,
    ) {
    }
}
