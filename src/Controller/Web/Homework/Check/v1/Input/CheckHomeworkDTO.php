<?php

namespace App\Controller\Web\Homework\Check\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CheckHomeworkDTO
{
    public function __construct(
        public int $userId,
        #[Assert\Expression(
            expression: '(this.exUserAnswer !== null)',
            message: 'exUserAnswer should be provided'
        )]
        public string $exUserAnswer,
        #[Assert\Expression(
            expression: '(this.$exTeacherComment !== null)',
            message: 'exTeacherComment should be provided'
        )]
        public string $exTeacherComment,
        public int $exerciseId,
        public int $exSpeakPoint,
        public int $exAudioPoint,
        #[Assert\Choice(choices: [1], message: 'The value must be 1.')]
        public int $isVerified,
    ) {
    }
}
