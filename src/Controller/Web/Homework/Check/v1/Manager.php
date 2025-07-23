<?php

namespace App\Controller\Web\Homework\Check\v1;

use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;
use App\Domain\Service\HomeworkService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateHomeworkModel> */
        private readonly HomeworkService $homeworkService,
    ) {
    }

    public function checkHomework(ExerciseUserPoint $exerciseUserPoint, string $exTeacherComment, int $exSpeakPoint, int $exAudioPoint): void
    {
        $this->homeworkService->checkHomework($exerciseUserPoint, $exTeacherComment, $exSpeakPoint, $exAudioPoint);
    }
}
