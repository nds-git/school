<?php

namespace App\Controller\Web\User\AddCourse\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class AddCourseUserDTO
{
    public function __construct(
        #[Assert\NotNull(
            message: 'User ID should not be null'
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'User ID should be an integer'
        )]
        public readonly int $userId,
        #[Assert\NotNull(
            message: 'Course ID should not be null'
        )]
        #[Assert\Type(
            type: 'integer',
            message: 'Course ID should be an integer'
        )]
        public readonly int $courseId,
    ) {
    }
}
