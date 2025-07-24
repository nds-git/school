<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\ExerciseUserPointRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;

class HomeworkService
{
    public function __construct(
        private readonly ExerciseUserPointService $exerciseUserPointService,
        private readonly UserRepository $userRepository,
        private readonly ExerciseUserPointRepository $exerciseUserPointRepository,
    ) {
    }

    public function createHomework(CreateHomeworkModel $createHomeworkModel): ExerciseUserPoint
    {
        $user = $this->userRepository->find($createHomeworkModel->userId);

        return $this->exerciseUserPointService->createExerciseUserPoint($createHomeworkModel, $user);
    }

    public function checkHomework(ExerciseUserPoint $exerciseUserPoint, string $exTeacherComment, int $exSpeakPoint, int $exAudioPoint): void
    {
        $this->exerciseUserPointRepository->checkHomework($exerciseUserPoint, $exTeacherComment, $exSpeakPoint, $exAudioPoint);
    }
}
