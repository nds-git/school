<?php

namespace App\Controller\Web\User\Create\v1;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Domain\Event\CreateUserEvent;
use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(
        private readonly UserService $userService,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function create(string $login, string $name): ?User
    {
        $event = new CreateUserEvent($login, $name);
        $this->eventDispatcher->dispatch($event);

        return $event->id === null ? null : $this->userService->findUserById($event->id);
    }
}