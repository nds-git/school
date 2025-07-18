<?php

namespace App\Controller\Web\User\UpdateLogin\v1;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\User;

#[AsController]
class Controller
{
    public function __construct(private readonly Manager $manager) {
    }

    #[Route(path: 'api/v1/user/{id}', methods: ['PATCH'])]
    public function __invoke(#[MapEntity(expr: 'repository.find(id)')] User $user, Request $request): Response
    {
        $login = $request->query->get('login');
        $this->manager->updateLogin($user, $login);

        return new JsonResponse(['success' => true]);
    }
}