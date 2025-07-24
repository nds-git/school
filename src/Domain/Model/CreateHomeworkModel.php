<?php

namespace App\Domain\Model;

readonly class CreateHomeworkModel
{
    public function __construct(
        public int $userId,
        public string $exUserAnswer,
        public ?string $exTeacherComment,
        public int $exerciseId,
        public ?int $exSpeakPoint,
        public ?int $exAudioPoint,
        public int $isVerified,
    ) {
    }
}
