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

    public function postExercise(Lecture $lecture, string $titleExercise, int $isActive): Exercise
    {
        $exercise = new Exercise();
        $exercise->setLecture($lecture);
        $exercise->setTitleExercise($titleExercise);
        $exercise->setCreatedAt();
        $exercise->setUpdatedAt();
        $exercise->setIsActive($isActive);
        $lecture->addExercise($exercise);

        $this->exerciseRepository->create($exercise);

        return $exercise;
    }
}
