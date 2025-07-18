<?php

namespace App\Controller\Web\User\GetByLogin\v1;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\Entity\User;

#[AsController]
class Controller
{
    #[Route(path: '/api/v1/get-user-by-login/{login}', methods: ['GET'])]
    public function getUserByLoginAction(#[MapEntity(mapping: ['login' => 'login'])] User $user): Response
    {
        return new JsonResponse(['user' => $user->toArray()], Response::HTTP_OK);
    }
}