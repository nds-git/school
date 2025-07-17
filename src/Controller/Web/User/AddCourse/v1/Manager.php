<?php

namespace App\Controller\Web\User\AddCourse\v1;

use App\Controller\Web\User\AddCourse\v1\Output\AddedCourseUserDTO;
use App\Controller\Web\User\AddCourse\v1\Input\AddCourseUserDTO;
use App\Domain\Model\AddCourseUserModel;
use App\Domain\Service\ModelFactory;
use App\Domain\Service\UserService;

class Manager
{
    public function __construct(
        /** @var ModelFactory<AddCourseUserModel> */
        private readonly ModelFactory $modelFactory,
        private readonly UserService $userService,
    ) {
    }

    public function addUserCourse(AddCourseUserDTO $addCourseDTO): AddedCourseUserDTO
    {
        $addCourseUserModel =  $this->modelFactory->makeModel(AddCourseUserModel::class, $addCourseDTO->userId, $addCourseDTO->courseId);
        $user = $this->userService->addUserCourse($addCourseUserModel);

        return new AddedCourseUserDTO(
            $user->getId(),
            $user->getLogin(),
            $user->getName(),
            $user->getCreatedAt()->format('Y-m-d H:i:s'),
            $user->getUpdatedAt()->format('Y-m-d H:i:s'),
            $user->getCourses(),
        );
    }
}
