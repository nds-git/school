<?php

namespace App\Domain\Model;

readonly class CreateUserModel
{
    public function __construct(
        public string $login,
        public string $name,
        public string $password = 'myPass',
        public int $age = 18,
        public int $isActive = 0,
    ) {
    }
}
