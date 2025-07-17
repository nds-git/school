<?php

namespace App\Domain\Model;

class CreateUserModel
{
    public function __construct(
        public readonly string $login,
        public readonly string $name,
    ) {
    }
}
