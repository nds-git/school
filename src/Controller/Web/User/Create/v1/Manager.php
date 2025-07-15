<?php

namespace App\Controller\Web\User\Create\v1;

use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function create(string $login, string $name): ?User
    {
        return $this->userService->createUser($login, $name);
    }
}