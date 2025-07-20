<?php

namespace App\Controller\Web\User\UserForm\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
    expression: '(this.login !== null and this.name !== null)',
    message: 'Both login and name should be provided'
)]
class CreateUserDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public ?string $login = null,
        #[Assert\NotBlank]
        public ?string $name = null,
        #[Assert\NotBlank]
        public ?string $password = '123',
        public int $age = 0,
        public int $isActive = 0,
    ) {
    }
}