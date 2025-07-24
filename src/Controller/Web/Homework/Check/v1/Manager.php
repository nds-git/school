<?php

namespace App\Controller\Web\Homework\Check\v1;

use App\Controller\Amqp\UserSumLecturePoint\UserSumLecturePointProducer;
use App\Domain\DTO\AddLectureUserPointDTO;
use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Entity\ExerciseUserPoint;
use App\Domain\Service\HomeworkService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateHomeworkModel> */
        private readonly HomeworkService $homeworkService,
        private readonly UserSumLecturePointProducer $userSumLecturePointProducer,
    ) {
    }

    public function checkHomework(ExerciseUserPoint $exerciseUserPoint, string $exTeacherComment, int $exSpeakPoint, int $exAudioPoint): void
    {
        $this->homeworkService->checkHomework($exerciseUserPoint, $exTeacherComment, $exSpeakPoint, $exAudioPoint);
        $message = new AddLectureUserPointDTO($exerciseUserPoint->getUser()->getId(), $exerciseUserPoint->getExercise()->getLectureId());

        $this->userSumLecturePointProducer->sumLecturePoints($message);
    }
}
