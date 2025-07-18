<?php

namespace App\Domain\Model;

class AddCourseUserModel
{
    public function __construct(
        public readonly int $userId,
        public readonly int $courseId,
    ) {
    }
}
