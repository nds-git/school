<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\LectureUserPoint;

/**
 * @extends AbstractRepository<LectureUserPoint>
 */
class LectureUserPointRepository extends AbstractRepository
{
    public function create(LectureUserPoint $lectureUserPoint): int
    {
        return $this->store($lectureUserPoint);
    }

    public function getSumLecturePoint(int $userId, array $lectureIds): array
    {
        if (!$userId || empty($lectureIds)) {
            return [];
        }

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('SUM(eup.sumLecturePoint) AS sumLecturePoint')
            ->from('App\Domain\Entity\LectureUserPoint', 'eup')
            ->where('eup.userId = :userId')
            ->andWhere('eup.lectureId IN (:lectureIds)')
            ->setParameter('userId', $userId)
            ->setParameter('lectureIds', $lectureIds);

        $result = $qb->getQuery()->getScalarResult() ?? [];

        return $result;
    }
}
