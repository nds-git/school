<?php

namespace App\Controller\Web\User\Create\v1\Output;

use App\Controller\DTO\OutputDTOInterface;

class CreatedUserDTO implements OutputDTOInterface
{
    public function __construct(
        public readonly int $id,
        public readonly string $login,
        public readonly string $name,
        public readonly string $createdAt,
        public readonly string $updatedAt,
    ) {
    }
}
