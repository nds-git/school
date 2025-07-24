<?php

namespace App\Controller\Web\Homework\Create\v1\Output;

use App\Controller\DTO\OutputDTOInterface;

readonly class CreatedHomeworkDTO implements OutputDTOInterface
{
    public function __construct(
        public int $id,
        public string $exUserAnswer,
        public ?string $exTeacherComment,
        public int $exerciseId,
        public ?int $exSpeakPoint,
        public ?int $exAudioPoint,
        public int $isVerified,
    ) {
    }
}
