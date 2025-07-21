<?php

namespace App\Domain\Service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Infrastructure\Repository\CourseRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Domain\Model\AddCourseUserModel;
use App\Domain\Model\UpdateUserModel;
use App\Domain\Model\CreateUserModel;
use App\Domain\Entity\Course;
use App\Domain\Entity\User;
use DateInterval;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly CourseRepository $courseRepository,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
    ) {
    }

    public function createUser(CreateUserModel $createUserModel): User
    {
        $user = new User();
        $user->setLogin($createUserModel->login);
        $user->setName($createUserModel->name);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $createUserModel->password));
        $user->setAge($createUserModel->age);
        $user->setIsActive($createUserModel->isActive);
        $user->setRoles($createUserModel->roles);
        $this->userRepository->create($user);

        return $user;
    }

    public function updateUserFromForm(UpdateUserModel $updateUserModel, User $user): User
    {
        $user->setLogin($updateUserModel->login);
        $user->setName($updateUserModel->name);
        $user->setPassword($updateUserModel->password);
        $user->setAge($updateUserModel->age);
        $user->setIsActive($updateUserModel->isActive);

        return $this->userRepository->updateUser($user);
    }

    public function processFromForm(User $user): void
    {
        $this->userRepository->create($user);
    }

    /**
     * @return User[]
     */
    public function findUserByLogin(string $login): array
    {
        return $this->userRepository->findUserByLogin($login);
    }

    public function findUserById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function updateLogin(User $user, string $login): void
    {
        $this->userRepository->updateLogin($user, $login);
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

    public function remove(User $user): void
    {
        $this->userRepository->remove($user);
    }

    public function removeById(int $userId): bool
    {
        $user = $this->userRepository->find($userId);
        if ($user instanceof User) {
            $this->userRepository->remove($user);

            return true;
        }

        return false;
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

    public function addUserCourse(AddCourseUserModel $addCourseUserModel): User
    {
        $user = $this->userRepository->find($addCourseUserModel->userId);
        $course = $this->courseRepository->find($addCourseUserModel->courseId);
        $users = $course->getUsers();

        if ($user instanceof User && $course instanceof Course && !$users->contains($user)) {
            $course->addUser($user);
            $this->userRepository->courseUser($user, $course);
        }

        return $user;
    }
}
