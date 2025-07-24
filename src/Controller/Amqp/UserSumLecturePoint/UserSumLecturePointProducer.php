<?php

namespace App\Controller\Amqp\UserSumLecturePoint;

use App\Domain\Bus\AddLectureUserPointBusInterface;
use App\Domain\DTO\AddLectureUserPointDTO;

class UserSumLecturePointProducer
{

    public function __construct(
        private readonly AddLectureUserPointBusInterface $addLectureUserPointBus,
    ) {
    }

    public function sumLecturePoints(AddLectureUserPointDTO $addLectureUserPointDTO): bool
    {
        return $this->addLectureUserPointBus->sendLectureUserPointMessage($addLectureUserPointDTO);
    }
}
