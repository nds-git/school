<?php

namespace App\Controller\Web\User\AddCourse\v1;

use App\Controller\Web\User\AddCourse\v1\Output\AddedCourseUserDTO;
use App\Controller\Web\User\AddCourse\v1\Input\AddCourseUserDTO;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class Controller
{
    public function __construct(
        private readonly Manager $manager,
    ) {
    }

    #[Route(path: 'api/v1/user/add-course', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] AddCourseUserDTO $addCourseDTO): AddedCourseUserDTO
    {
        return $this->manager->addUserCourse($addCourseDTO);
    }
}
