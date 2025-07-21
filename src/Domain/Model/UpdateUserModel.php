<?php

namespace App\Domain\Model;

readonly class UpdateUserModel
{
    public function __construct(
        public string $login,
        public string $name,
        public string $password = '123',
        public int $age = 0,
        public int $isActive = 0,
    ) {
    }
}
