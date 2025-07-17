<?php

namespace App\Controller\Web\Course\CreateWithExercises\v1;

use App\Controller\Web\Course\Create\v1\Output\CreatedCourseDTO;
use App\Controller\Web\Course\Create\v1\Input\CreateCourseDTO;
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

    #[Route(path: 'api/v1/course/lecture/exercises', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateCourseDTO $createCourseDTO): CreatedCourseDTO
    {
        return $this->manager->create($createCourseDTO);
    }
}
