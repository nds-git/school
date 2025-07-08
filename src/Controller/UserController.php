<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Service\UserService;

class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    public function createUser(): Response
    {
        $user = $this->userService->create('dima', 'Dmitriy');

        return $this->json($user->toArray());
    }
}