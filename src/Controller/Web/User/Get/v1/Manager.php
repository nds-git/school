<?php

namespace App\Controller\Web\User\Get\v1;

use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function getUserById(int $userId): ?User
    {
        return $this->userService->findUserById($userId);
    }

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        return $this->userService->findAll();
    }
}
