<?php

namespace App\Controller\Web\User\UserForm\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\User;

class EditController extends AbstractController
{
    public function __construct(private readonly Manager $manager)
    {
    }

    #[Route(path: '/api/v1/update-user/{id}', methods: ['GET', 'PATCH'])]
    public function manageUserAction(Request $request, #[MapEntity(id: 'id')] User $user): Response
    {
        return $this->render('update-user.twig', $this->manager->getFormData($request, $user));
    }
}
