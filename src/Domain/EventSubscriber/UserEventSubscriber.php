<?php

namespace App\Domain\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Domain\Event\CreateUserEvent;
use App\Domain\Service\UserService;

class UserEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CreateUserEvent::class => 'onCreateUser'
        ];
    }

    public function onCreateUser(CreateUserEvent $event): void
    {
        $user = null;

        $user = $this->userService->createUser($event->login, $event->name);

        $event->id = $user?->getId();
    }
}
