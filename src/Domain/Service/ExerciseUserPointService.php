<?php

namespace App\Domain\Service;

use App\Domain\Entity\Exercise;
use App\Infrastructure\Repository\ExerciseUserPointRepository;
use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;
use App\Domain\Entity\User;

class ExerciseUserPointService
{
    public function __construct(private readonly ExerciseUserPointRepository $exerciseUserPointRepository)
    {
    }

    public function createExerciseUserPoint(CreateHomeworkModel $createHomeworkModel, User $user, Exercise $exercise): ExerciseUserPoint
    {
        $homework = new ExerciseUserPoint();
        $homework->setUser($user);
        $homework->setExUserAnswer($createHomeworkModel->exUserAnswer);
        $homework->setExTeacherComment($createHomeworkModel->exTeacherComment);
        $homework->setExercise($exercise);
        $homework->setExSpeakPoint($createHomeworkModel->exSpeakPoint);
        $homework->setExAudioPoint($createHomeworkModel->exAudioPoint);
        $homework->setIsVerified($createHomeworkModel->isVerified);

        $this->exerciseUserPointRepository->create($homework);

        return $homework;
    }

    public function getSumExercisesPoint(int $userId, array $exerciseIds): array
    {
        return $this->exerciseUserPointRepository->getSumExercisesPoint($userId, $exerciseIds);
    }
}
