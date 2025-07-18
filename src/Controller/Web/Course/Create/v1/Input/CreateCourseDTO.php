<?php

namespace App\Controller\Web\Course\Create\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateCourseDTO
{
    public function __construct(
        #[Assert\Expression(
            expression: '(this.titleCourse !== null)',
            message: 'TitleCourse should be provided'
        )]
        public string $titleCourse,
        #[Assert\Choice(choices: [0,1])]
        public int $isActive,
        public ?array $titleLectures,
    ) {
    }
}
