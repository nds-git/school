<?php

namespace App\Infrastructure\Bus\Adapter;

use App\Domain\Bus\AddLectureUserPointBusInterface;
use App\Infrastructure\Bus\AmqpExchangeEnum;
use App\Domain\DTO\AddLectureUserPointDTO;
use App\Infrastructure\Bus\RabbitMqBus;

class AddLectureUserPointRabbitMqBus implements AddLectureUserPointBusInterface
{

    public function __construct(private readonly RabbitMqBus $rabbitMqBus)
    {
    }

    public function sendLectureUserPointMessage(AddLectureUserPointDTO $addLectureUserPointDTO): bool
    {
        $message = new AddLectureUserPointDTO($addLectureUserPointDTO->userId, $addLectureUserPointDTO->lectureId);

        return $this->rabbitMqBus->publishToExchange(AmqpExchangeEnum::UserSumLecturePoint, $message);
    }
}
