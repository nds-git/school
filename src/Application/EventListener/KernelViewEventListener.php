<?php

namespace App\Application\EventListener;

use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\DTO\OutputDTOInterface;

class KernelViewEventListener
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function onKernelView(ViewEvent $event): void
    {
        $dto = $event->getControllerResult();

        if ($dto instanceof OutputDTOInterface) {
            $event->setResponse($this->getDTOResponse($dto));
        }
    }

    private function getDTOResponse($data): Response {
        $serializedData = $this->serializer->serialize($data, 'json', [AbstractObjectNormalizer::SKIP_NULL_VALUES => true]);

        return new JsonResponse($serializedData, Response::HTTP_OK, [], true);
    }
}
