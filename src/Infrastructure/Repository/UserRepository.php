<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Course;
use Doctrine\Common\Collections\Criteria;
use App\Domain\Entity\User;
use DateInterval;

/**
 * @extends AbstractRepository<User>
 */
class UserRepository extends AbstractRepository
{
    public function create(User $user): int
    {
        return $this->store($user);
    }

    public function find(int $userId): ?User
    {
        $repository = $this->entityManager->getRepository(User::class);
        /** @var User|null $user */
        $user = $repository->find($userId);

        return $user;
    }

    public function updateLogin(User $user, string $login): void
    {
        $user->setLogin($login);
        $this->flush();
    }

    /**
     * @return User[]
     */
    public function findUserByLogin(string $login): array
    {
        $criteria = Criteria::create();
        $criteria->andWhere(Criteria::expr()?->eq('login', $login));
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->matching($criteria)->toArray();
    }

    public function findUsersByLoginWithQueryBuilder(string $login): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->andWhere($queryBuilder->expr()->like('u.login',':userLogin'))
            ->setParameter('userLogin', "%$login%");

        return $queryBuilder->getQuery()->getResult();
    }

    public function updateUserLoginWithQueryBuilder(int $userId, string $login): void
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder->update(User::class,'u')
            ->set('u.login', ':userLogin')
            ->where($queryBuilder->expr()->eq('u.id', ':userId'))
            ->setParameter('userId', $userId)
            ->setParameter('userLogin', $login);

        $queryBuilder->getQuery()->execute();
    }

    public function remove(User $user): void
    {
        $user->setDeletedAt();
        $this->flush();
    }

    public function removeInFuture(User $user, DateInterval $dateInterval): void
    {
        $user->setDeletedAtInFuture($dateInterval);
        $this->flush();
    }

    /**
     * @return User[]
     */
    public function findUsersByLoginWithDeleted(string $name): array
    {
        $filters = $this->entityManager->getFilters();
        if ($filters->isEnabled('soft_delete_filter')) {
            $filters->disable('soft_delete_filter');
        }
        return $this->entityManager->getRepository(User::class)->findBy(['login' => $name]);
    }

    public function courseUser(User $user, Course $course): void
    {
        $user->addCourse($course);
        $course->addUser($user);
        $this->entityManager->flush();
    }
}
