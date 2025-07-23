<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\ExerciseUserPoint;

/**
 * @extends AbstractRepository<ExerciseUserPoint>
 */
class ExerciseUserPointRepository extends AbstractRepository
{
    public function create(ExerciseUserPoint $exerciseUserPoint): int
    {
        return $this->store($exerciseUserPoint);
    }

    public function checkHomework(ExerciseUserPoint $exerciseUserPoint, string $exTeacherComment, int $exSpeakPoint, int $exAudioPoint): void
    {
        $exerciseUserPoint->setExTeacherComment($exTeacherComment);
        $exerciseUserPoint->setExSpeakPoint($exSpeakPoint);
        $exerciseUserPoint->setExAudioPoint($exAudioPoint);
        $exerciseUserPoint->setIsVerified(1);
        $this->flush();
    }
}
