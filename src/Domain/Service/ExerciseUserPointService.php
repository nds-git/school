<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\ExerciseUserPointRepository;
use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;

class ExerciseUserPointService
{
    public function __construct(private readonly ExerciseUserPointRepository $exerciseUserPointRepository)
    {
    }

    public function createExerciseUserPoint(CreateHomeworkModel $createHomeworkModel): ExerciseUserPoint
    {
        $homework = new ExerciseUserPoint();
        $homework->setUserId($createHomeworkModel->userId);
        $homework->setExUserAnswer($createHomeworkModel->exUserAnswer);
        $homework->setExTeacherComment($createHomeworkModel->exTeacherComment);
        $homework->setExerciseId($createHomeworkModel->exerciseId);
        $homework->setExSpeakPoint($createHomeworkModel->exSpeakPoint);
        $homework->setExAudioPoint($createHomeworkModel->exAudioPoint);
        $homework->setIsVerified($createHomeworkModel->isVerified);

        $this->exerciseUserPointRepository->create($homework);

        return $homework;
    }
}
