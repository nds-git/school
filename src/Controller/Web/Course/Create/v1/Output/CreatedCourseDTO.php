<?php

namespace App\Controller\Web\Course\Create\v1\Output;

use App\Controller\DTO\OutputDTOInterface;

readonly class CreatedCourseDTO implements OutputDTOInterface
{
    public function __construct(
        public int $id,
        public string $titleCourse,
        public string $isActive,
        public string $createdAt,
        public string $updatedAt,
        public ?array $titleLectures,
    ) {
    }
}
