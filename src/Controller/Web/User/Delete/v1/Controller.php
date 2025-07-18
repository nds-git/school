<?php

namespace App\Controller\Web\User\Delete\v1;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Domain\Entity\User;

#[AsController]
class Controller
{
    public function __construct(private readonly Manager $manager) {
    }

    #[Route(path: 'api/v1/user/{id}', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function __invoke(#[MapEntity(id: 'id')] User $user): Response
    {
        $this->manager->deleteUser($user);

        return new JsonResponse(['success' => true]);
    }
}
