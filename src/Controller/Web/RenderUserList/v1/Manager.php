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
                'age' => $user->getAge(),
                'isActive' => $user->getIsActive(),
            ];

            return $result;
        };

        // Получаем всех пользователей
        $users = $this->userService->findAll();

        // Сортируем массив пользователей по id
        usort($users, function (User $a, User $b) {
            return $a->getId() <=> $b->getId(); // Сравнение по id
        });

        // Применяем маппер к отсортированному массиву
        return array_map($mapper, $users);
    }
}