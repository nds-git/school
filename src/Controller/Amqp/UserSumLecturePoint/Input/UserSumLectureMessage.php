<?php

namespace App\Controller\Amqp\UserSumLecturePoint\Input;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UserSumLectureMessage
{
    public function __construct(
        #[Assert\Type('numeric')]
        public int $userId,
        #[Assert\Type('numeric')]
        public int $lectureId,
    ) {
    }
}