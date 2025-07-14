<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;

class UserBuilderService
{
    public function __construct(
        private readonly CourseService $courseService,
        private readonly UserService $userService,
    ) {
    }

    /**
     * @param string[] $texts
     */
    public function createUserWithCourses(string $login, string $name, array $texts): User
    {
        $user = $this->userService->create($login, $name);
        foreach ($texts as $text) {
            $this->courseService->postCourse($user, $text);
        }

        return $user;
    }
}
