<?php

namespace App\Domain\Model;

readonly class CreateUserModel
{
    public function __construct(
        public string $login,
        public string $name,
        public string $password,
        public int $age,
        public int $isActive,
    ) {
    }
}
