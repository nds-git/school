<?php

namespace App\Controller\Web\Homework\Create\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateHomeworkDTO
{
    public function __construct(
        public int $userId,
        #[Assert\Expression(
            expression: '(this.exUserAnswer !== null)',
            message: 'exUserAnswer should be provided'
        )]
        public string $exUserAnswer,
        public ?string $exTeacherComment,
        public int $exerciseId,
        public ?int $exSpeakPoint,
        public ?int $exAudioPoint,
        #[Assert\Choice(choices: [0,1])]
        public int $isVerified,
    ) {
    }
}
