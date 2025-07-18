<?php

namespace App\Controller\Web\User\UpdateLogin\v1;

use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function updateLogin(User $user, string $login): void
    {
        $this->userService->updateLogin($user, $login);
    }
}