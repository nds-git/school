<?php

namespace App\Controller\Web\User\Create\v1;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[AsController]
class Controller
{
    public function __construct(private readonly Manager $manager) {
    }

    #[Route(path: 'api/v1/user', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $login = $request->request->get('login');
        $name = $request->request->get('name');
        $user = $this->manager->create($login, $name);
        if ($user === null) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($user->toArray());
    }
}