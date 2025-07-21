<?php

namespace App\Controller\Web\User\UserForm\v1;

use App\Controller\Web\User\UserForm\v1\Input\CreateUserDTO;
use App\Controller\Web\User\UserForm\v1\Input\UpdateUserDTO;
use App\Domain\Model\UpdateUserModel;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Model\CreateUserModel;
use App\Domain\Service\ModelFactory;
use App\Domain\Service\UserService;
use App\Controller\Form\UserType;
use App\Domain\Entity\User;

class Manager
{
    public function __construct(
        private readonly UserService $userService,
        private readonly FormFactoryInterface $formFactory,
        private readonly ModelFactory $modelFactory,
    ) {
    }

    public function getFormData(Request $request, ?User $user = null): array
    {
        $isNew = !$user;

        $formData = $isNew ? null : new CreateUserDTO(
            $user->getLogin(),
            $user->getName(),
            $user->getPassword(),
            $user->getAge(),
            $user->getIsActive(),
        );

        $form = $this->formFactory->create(UserType::class, $formData, ['isNew' => $isNew]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($isNew) {
                /** @var CreateUserDTO $createUserDTO */
                $createUserDTO = $form->getData();
                $createUserModel = $this->modelFactory->makeModel(
                    CreateUserModel::class,
                    $createUserDTO->login,
                    $createUserDTO->name,
                    $createUserDTO->password,
                    $createUserDTO->age,
                    $createUserDTO->isActive ?? 0,
                );

                $user = $this->userService->createUser($createUserModel);
            } else {
                /** @var UpdateUserDTO $updateUserDTO */
                $updateUserDTO = $form->getData();
                $updateUserModel = $this->modelFactory->makeModel(
                    UpdateUserModel::class,
                    $updateUserDTO->login,
                    $updateUserDTO->name,
                    $updateUserDTO->password,
                    $updateUserDTO->age,
                    $updateUserDTO->isActive,
                );

                $user =  $this->userService->updateUserFromForm($updateUserModel, $user);
            }
        }

        return [
            'form' => $form,
            'isNew' => $isNew,
            'user' => $user,
        ];
    }
}
