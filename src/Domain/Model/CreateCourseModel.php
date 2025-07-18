<?php

namespace App\Domain\Model;

class CreateCourseModel
{
    public function __construct(
        public readonly string $titleCourse,
        public readonly int $isActive,
        public readonly ?array $titleLectures,
    ) {
    }
}
