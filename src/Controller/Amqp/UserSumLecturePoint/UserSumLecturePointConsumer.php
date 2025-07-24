<?php

namespace App\Controller\Amqp\UserSumLecturePoint;

use App\Controller\Amqp\UserSumLecturePoint\Input\UserSumLectureMessage;
use App\Application\RabbitMq\AbstractConsumer;
use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class UserSumLecturePointConsumer extends AbstractConsumer
{
    public function __construct(
        private readonly UserService $userService,
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
        dd($message);
        if (!($user instanceof User)) {
            return $this->reject(sprintf('User ID %s was not found', $message->userId));
        }
        // посчитать общее кол-во баллов за все домашние задания по конкретной лекции
        // и записатьв таблицу lecture_user_point
//        $this->userSumLecturePointService->calculateUserLecturePoint($user->getId(), $message->lectureId);

        return self::MSG_ACK;
    }
}