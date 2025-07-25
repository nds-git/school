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

    public function getSumExercisesPoint(int $userId, array $exerciseIds): array
    {
        // Убедитесь, что $exerciseIds не пустой
        if (empty($exerciseIds)) {
            return [];
        }

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('SUM(eup.exSpeakPoint) + SUM(eup.exAudioPoint) AS totalPoints')
            ->from('App\Domain\Entity\ExerciseUserPoint', 'eup')
            ->where('eup.userId = :userId')
            ->andWhere('eup.exerciseId IN (:exerciseIds)')
            ->setParameter('userId', $userId)
            ->setParameter('exerciseIds', $exerciseIds);

        $result = $qb->getQuery()->getScalarResult() ?? [];

        return $result;
    }
}
