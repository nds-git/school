<?php

namespace App\Controller\Web\Course\Get\v1;


use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\Course;

#[AsController]
class Controller
{
    public function __construct(private readonly Manager $manager) {
    }

    #[Route(path: 'api/v1/course', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $courseId = $request->query->get('id');
        if ($courseId === null) {
            return new JsonResponse(array_map(static fn (Course $course): array => $course->toArray(), $this->manager->getAllCourses()));
        }

        $course = $this->manager->findCourseById($courseId);

        if ($course instanceof Course) {
            return new JsonResponse($course->toArray());
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}
