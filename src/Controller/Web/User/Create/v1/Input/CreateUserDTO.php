<?php

namespace App\Controller\Web\User\Create\v1\Input;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO
{
    public function __construct(
        #[Assert\Expression(
            expression: '(this.login !== null and this.name !== null)',
            message: 'Both login and name should be provided'
        )]
        #[Assert\Length(max: 10)]
        public readonly string $login,
        public readonly string $name,
    ) {
    }
}
