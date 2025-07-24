<?php

namespace App\Infrastructure\Bus;

enum AmqpExchangeEnum: string
{
    case UserLecturePointSum = 'user_lecture_point_sum';
}
