<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\UserRepository;
use App\Domain\Entity\User;
use DateInterval;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function create(string $login, string $name): User
    {
        $user = new User();
        $user->setLogin($login);
        $user->setName($name);
        $this->userRepository->create($user);

        return $user;
    }

    /**
     * @return User[]
     */
    public function findUserByLogin(string $login): array
    {
        return $this->userRepository->findUserByLogin($login);
    }

    public function updateUserLogin(int $userId, string $login): ?User
    {
        $user = $this->userRepository->find($userId);
        if (!($user instanceof User)) {
            return null;
        }
        $this->userRepository->updateLogin($user, $login);

        return $user;
    }

    public function findUsersByLoginWithQueryBuilder(string $login): array
    {
        return $this->userRepository->findUsersByLoginWithQueryBuilder($login);
    }

    public function updateUserLoginWithQueryBuilder(int $userId, string $login): ?User
    {
        $user = $this->userRepository->find($userId);
        if (!($user instanceof User)) {
            return null;
        }
        $this->userRepository->updateUserLoginWithQueryBuilder($user->getId(), $login);
        $this->userRepository->refresh($user);

        return $user;
    }

    public function removeById(int $userId): void
    {
        $user = $this->userRepository->find($userId);
        if ($user instanceof User) {
            $this->userRepository->remove($user);
        }
    }

    public function removeByIdInFuture(int $userId, DateInterval $dateInterval): void
    {
        $user = $this->userRepository->find($userId);
        if ($user instanceof User) {
            $this->userRepository->removeInFuture($user, $dateInterval);
        }
    }

    /**
     * @return User[]
     */
    public function findUsersByLoginWithDeleted(string $login): array
    {
        return $this->userRepository->findUsersByLoginWithDeleted($login);
    }
}
