<?php

namespace App\Controller\Web\User\AddCourse\v1\Output;

use App\Controller\DTO\OutputDTOInterface;

class AddedCourseUserDTO implements OutputDTOInterface
{
    public function __construct(
        public readonly int $id,
        public readonly string $login,
        public readonly string $name,
        public readonly string $createdAt,
        public readonly string $updatedAt,
        public readonly ?array $courses,
    ) {
    }
}