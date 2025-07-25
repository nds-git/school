<?php

namespace App\Domain\Model;

use App\Domain\Entity\Course;
use App\Domain\Entity\User;

readonly class CourseUserPointModel
{
    public function __construct(
        public User $user,
        public Course $course,
        public ?int $sumLecturePoint,
        public int $isVerified,
    ) {
    }
}
