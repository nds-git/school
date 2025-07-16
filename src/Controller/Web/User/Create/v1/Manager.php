<?php

namespace App\Controller\Web\User\Create\v1;

use App\Controller\Web\User\Create\v1\Output\CreatedUserDTO;
use App\Controller\Web\User\Create\v1\Input\CreateUserDTO;
use App\Domain\Model\CreateUserModel;
use App\Domain\Service\ModelFactory;
use App\Domain\Service\UserService;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateUserModel> */
        private readonly ModelFactory $modelFactory,
        private readonly UserService $userService,
    ) {
    }

    public function create(CreateUserDTO $createUserDTO): CreatedUserDTO
    {
        $createUserModel =  $this->modelFactory->makeModel(CreateUserModel::class, $createUserDTO->login, $createUserDTO->name);

        $user = $this->userService->createUser($createUserModel);

        return new CreatedUserDTO(
            $user->getId(),
            $user->getLogin(),
            $user->getName(),
            $user->getCreatedAt()->format('Y-m-d H:i:s'),
            $user->getUpdatedAt()->format('Y-m-d H:i:s'),
        );
    }
}
