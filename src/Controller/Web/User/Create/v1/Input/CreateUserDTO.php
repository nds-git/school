<?php

namespace App\Controller\Web\User\Create\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateUserDTO
{
    public function __construct(
        #[Assert\Expression(
            expression: '(this.login !== null and this.name !== null)',
            message: 'Both login and name should be provided'
        )]
        #[Assert\Length(max: 10)]
        public string $login,
        public string $name,
        public int $age,
        public int $isActive,
        public string $password,
    ) {
    }
}
