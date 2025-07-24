<?php

namespace App\Controller\Amqp\UserSumLecturePoint;

use App\Controller\Amqp\UserSumLecturePoint\Input\Message;
use App\Application\RabbitMq\AbstractConsumer;
use App\Domain\Service\UserSumLecturePointService;
use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Consumer extends AbstractConsumer
{
    public function __construct(
        private readonly UserService $userService,
        private readonly UserSumLecturePointService $userSumLecturePointService,
    ) {
    }

    protected function getMessageClass(): string
    {
        return Message::class;
    }

    /**
     * @param Message $message
     */
    protected function handle($message): int
    {
        $user = $this->userService->findUserById($message->userId);
        dd($user);
        if (!($user instanceof User)) {
            return $this->reject(sprintf('User ID %s was not found', $message->userId));
        }
        // посчитать общее кол-во баллов за все домашние задания по конкретной лекции
        // и записатьв таблицу lecture_user_point
        $this->userSumLecturePointService->calculateUserLecturePoint($user, $message->lectureId);

        return self::MSG_ACK;
    }
}