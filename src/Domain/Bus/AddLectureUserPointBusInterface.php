<?php

namespace App\Domain\Bus;

use App\Domain\DTO\AddLectureUserPointDTO;

interface AddLectureUserPointBusInterface
{
    public function sendLectureUserPointMessage(AddLectureUserPointDTO $addLectureUserPointDTO): bool;
}
