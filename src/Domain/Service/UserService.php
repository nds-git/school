<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\UserRepository;
use App\Domain\Entity\User;

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
        $user->setCreatedAt();
        $user->setUpdatedAt();
        $this->userRepository->create($user);

        return $user;
    }
}