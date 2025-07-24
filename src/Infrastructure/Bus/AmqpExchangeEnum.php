<?php

namespace App\Infrastructure\Bus;

enum AmqpExchangeEnum: string
{
    case UserSumLecturePoint = 'user_sum_lecture_point';
}
