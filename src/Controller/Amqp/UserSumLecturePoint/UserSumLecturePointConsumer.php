<?php

namespace App\Controller\Amqp\UserSumLecturePoint;

use App\Controller\Amqp\UserSumLecturePoint\Input\UserSumLectureMessage;
use App\Domain\Service\ExerciseUserPointService;
use App\Domain\Service\LectureUserPointService;
use App\Domain\Service\CourseUserPointService;
use App\Application\RabbitMq\AbstractConsumer;
use App\Domain\Model\LectureUserPointModel;
use App\Domain\Model\CourseUserPointModel;
use App\Domain\Service\LectureService;
use App\Domain\Service\ModelFactory;
use App\Domain\Service\UserService;
use App\Domain\Entity\Lecture;
use App\Domain\Entity\User;

class UserSumLecturePointConsumer extends AbstractConsumer
{
    public function __construct(
        /** @var ModelFactory<CourseUserPointModel> */
        /** @var ModelFactory<LectureUserPointModel> */
        private readonly ModelFactory $modelFactory,
        private readonly UserService $userService,
        private readonly LectureService $lectureService,
        private readonly ExerciseUserPointService $exerciseUserPointService,
        private readonly LectureUserPointService $lectureUserPointService,
        private readonly CourseUserPointService $courseUserPointService,
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

            $course = $lecture->getCourse();
            // из одной лекции извлекаем все активные ДЗ
            foreach ($course->getLectures() as $lecture) {
                if ($lecture['isActive'] === 0) {
                    $lectureIds[] = $lecture['id'];
                }
            }

            // теперь суммируем все баллы нашего юзера по конкретному курсу
            if (!empty($lectureIds)) {
                $sumLecturePoint = $this->lectureUserPointService->getSumLecturePoint($user->getId(), $lectureIds)[0];
                $courseUserPointModel =  $this->modelFactory->makeModel(
                    CourseUserPointModel::class,
                    $user,
                    $course,
                    (int)$sumLecturePoint['sumLecturePoint'],
                    1
                );

                $this->courseUserPointService->createCourseUserPoint($courseUserPointModel);
            }

        }

        return self::MSG_ACK;
    }
}
