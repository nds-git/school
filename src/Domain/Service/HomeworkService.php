<?php

namespace App\Domain\Service;

use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;

class HomeworkService
{
    public function __construct(
        private readonly ExerciseUserPointService $exerciseUserPointService,
    ) {
    }

    public function createHomework(CreateHomeworkModel $createHomeworkModel): ExerciseUserPoint
    {
        return $this->exerciseUserPointService->createExerciseUserPoint($createHomeworkModel);
    }
}
