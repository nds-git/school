<?php

namespace App\Controller\Web\User\UserForm\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class CreateController extends AbstractController
{
    public function __construct(private readonly Manager $manager)
    {
    }

    #[Route(path: '/api/v1/create-user', methods: ['GET', 'POST'])]
    public function manageUserAction(Request $request): Response
    {
        return $this->render('create-user.twig', $this->manager->getFormData($request));
    }
}
