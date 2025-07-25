<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\ExerciseRepository;
use App\Domain\Entity\Exercise;
use App\Domain\Entity\Lecture;

class ExerciseService
{
    public function __construct(private readonly ExerciseRepository $exerciseRepository)
    {
    }

    public function findExerciseById(int $id): ?Exercise
    {
        return $this->exerciseRepository->find($id);
    }

    public function postExercise(Lecture $lecture, string $titleExercise, int $speakPoint, int $audioPoint, int $isActive): Exercise
    {
        $exercise = new Exercise();
        $exercise->setLecture($lecture);
        $exercise->setTitleExercise($titleExercise);
        $exercise->setCreatedAt();
        $exercise->setUpdatedAt();
        $exercise->setMaxSpeakPoint($speakPoint);
        $exercise->setMaxAudioPoint($audioPoint);
        $exercise->setIsActive($isActive);
        $lecture->addExercise($exercise);

        $this->exerciseRepository->create($exercise);

        return $exercise;
    }
}
