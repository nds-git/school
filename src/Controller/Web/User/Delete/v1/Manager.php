<?php

namespace App\Controller\Web\User\Delete\v1;

use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function deleteUser(User $user): void
    {
        $this->userService->remove($user);
    }

    public function deleteUserById(int $userId): bool
    {
        return $this->userService->removeById($userId);
    }
}
