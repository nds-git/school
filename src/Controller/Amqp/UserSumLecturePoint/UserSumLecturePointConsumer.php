<?php

namespace App\Controller\Amqp\UserSumLecturePoint;

use App\Controller\Amqp\UserSumLecturePoint\Input\UserSumLectureMessage;
use App\Domain\Model\LectureUserPointModel;
use App\Domain\Service\ExerciseUserPointService;
use App\Domain\Service\LectureUserPointService;
use App\Application\RabbitMq\AbstractConsumer;
use App\Domain\Service\LectureService;
use App\Domain\Service\ModelFactory;
use App\Domain\Service\UserService;
use App\Domain\Entity\Lecture;
use App\Domain\Entity\User;

class UserSumLecturePointConsumer extends AbstractConsumer
{
    public function __construct(
        /** @var ModelFactory<LectureUserPointModel> */
        private readonly ModelFactory $modelFactory,
        private readonly UserService $userService,
        private readonly LectureService $lectureService,
        private readonly ExerciseUserPointService $exerciseUserPointService,
        private readonly LectureUserPointService $lectureUserPointService,
    ) {
    }

    protected function getMessageClass(): string
    {
        return UserSumLectureMessage::class;
    }

    /**
     * @param UserSumLectureMessage $message
     */
    protected function handle($message): int
    {
        $user = $this->userService->findUserById($message->userId);
        $lecture = $this->lectureService->findLectureById($message->lectureId);

        if (!($user instanceof User) || !($lecture instanceof Lecture)) {
            return $this->reject(sprintf('User or Lecture ID %s was not found', $message->userId));
        }

        // Инициализируем массив для хранения ID
        $exerciseIds = [];

        // из одной лекции извлекаем все активные ДЗ
        foreach ($lecture->getExercises() as $exercise) {
            if ($exercise['isActive'] === 0) {
                $exerciseIds[] = $exercise['id'];
            }
        }

        //получаем все баллы нашего юзера по конкретной лекции
        if (!empty($exerciseIds)) {
            $sumLecturePoint = $this->exerciseUserPointService->getSumExercisesPoint($user->getId(), $exerciseIds)[0];

            $lectureUserPointModel =  $this->modelFactory->makeModel(
                LectureUserPointModel::class,
                $user,
                $lecture,
                (int)$sumLecturePoint['totalPoints'],
                1
            );

            $this->lectureUserPointService->createLectureUserPoint($lectureUserPointModel);
        }

        return self::MSG_ACK;
    }
}