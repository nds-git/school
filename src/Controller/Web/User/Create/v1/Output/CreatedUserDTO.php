<?php

namespace App\Controller\Web\User\Create\v1\Output;

use App\Controller\DTO\OutputDTOInterface;

readonly class CreatedUserDTO implements OutputDTOInterface
{
    public function __construct(
        public int $id,
        public string $login,
        public string $name,
        public int $age,
        public int $isActive,
        public string $password,
        /** @var string[] $roles */
        public array $roles,
        public string $createdAt,
        public string $updatedAt,
    ) {
    }
}
