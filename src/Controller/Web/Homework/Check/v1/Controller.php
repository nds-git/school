<?php

namespace App\Controller\Web\Homework\Check\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\ExerciseUserPoint;

#[AsController]
class Controller extends AbstractController
{
    public function __construct(
        private readonly Manager $manager,
    ) {
    }

    #[Route(path: 'api/v1/homework/check/{id}', methods: ['PATCH'])]
    public function __invoke(#[MapEntity(expr: 'repository.find(id)')] ExerciseUserPoint $exerciseUserPoint, Request $request): Response
    {
        $exTeacherComment = $request->query->get('exTeacherComment');
        $exSpeakPoint =  $request->query->get('exSpeakPoint');
        $exAudioPoint =  $request->query->get('exAudioPoint');
        $this->manager->checkHomework($exerciseUserPoint, $exTeacherComment, $exSpeakPoint, $exAudioPoint);

        $calculatePointsProducer->calculatePoints($exerciseUserPoint->getExercise()->getLectureId());;
        return new JsonResponse(['success' => true]);
    }
}
