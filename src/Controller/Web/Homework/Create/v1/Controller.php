<?php

namespace App\Controller\Web\Homework\Create\v1;

use App\Controller\Web\Homework\Create\v1\Output\CreatedHomeworkDTO;
use App\Controller\Web\Homework\Create\v1\Input\CreateHomeworkDTO;
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

    #[Route(path: 'api/v1/homework', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateHomeworkDTO $createHomeworkDTO): CreatedHomeworkDTO
    {
        return $this->manager->create($createHomeworkDTO);
    }
}
