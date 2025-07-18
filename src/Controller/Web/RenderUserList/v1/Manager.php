<?php

namespace App\Controller\Web\RenderUserList\v1;

use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(private readonly UserService $userService) {
    }

    public function getUserListData(): array
    {
        $mapper = static function (User $user): array {
            $result = [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'name' => $user->getName(),
            ];

            return $result;
        };

        return array_map($mapper, $this->userService->findAll());
    }
}