<?php

namespace App\Controller\Web\User\UserForm\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

#[Assert\Expression(
    expression: '(this.login !== null and this.name !== null)',
    message: 'Both login and name should be provided'
)]
readonly class UpdateUserDTO
{
    public function __construct(
        #[Assert\Length(max: 10)]
        public string $login,
        public string $name,
        public int $age,
        public int $isActive,
        public string $password,
    ) {
    }
}