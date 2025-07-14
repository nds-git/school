<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Service\UserService;
use App\Domain\Entity\User;
use DateInterval;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    public function createUser(): Response
    {
        $user = $this->userService->create('kristi', 'Kristina');

        return $this->json($user->toArray());
    }

    public function findUserByLogin(): Response
    {
        $users = $this->userService->findUserByLogin('olga');

        return $this->json(array_map(static fn(User $user) => $user->toArray(), $users));
    }

    public function updateLogin(): Response
    {
        $user = $this->userService->updateUserLogin(1, 'Malena');
        [$data, $code] = $user === null ? [null, Response::HTTP_NOT_FOUND] : [$user->toArray(), Response::HTTP_OK];

        return $this->json($data, $code);
    }

    public function findUsersByLoginWithQB(): Response
    {
        $users = $this->userService->findUsersByLoginWithQueryBuilder('Malena');

        return $this->json(array_map(static fn(User $user) => $user->toArray(), $users));
    }

    public function updateUsersByLoginWithQB(): Response
    {
        /** @var User $user */
        $user = $this->userService->updateUserLoginWithQueryBuilder(1, 'olga');

        return $this->json($user->toArray());
    }

    public function removeUser(): Response
    {
        $user = $this->userService->create('jack', 'London');
        $this->userService->removeById($user->getId());
        $usersByLogin = $this->userService->findUserByLogin($user->getLogin());

        return $this->json(['users' => array_map(static fn (User $user) => $user->toArray(), $usersByLogin)]);
    }

    public function removeUserFuture(): Response
    {
        $user = $this->userService->create('William', 'Shakespeare');
        $this->userService->removeByIdInFuture($user->getId(), DateInterval::createFromDateString('+5 min'));
        $usersByLogin = $this->userService->findUserByLogin($user->getLogin());

        return $this->json(['users' => array_map(static fn (User $user) => $user->toArray(), $usersByLogin)]);
    }

    public function findUserLoginWithDeleted(): Response
    {
        $user = $this->userService->create('tonni', 'Stark');
        $this->userService->removeById($user->getId());
        $usersByLogin = $this->userService->findUsersByLoginWithDeleted($user->getLogin());

        return $this->json(['users' => array_map(static fn (User $user) => $user->toArray(), $usersByLogin)]);
    }
}
