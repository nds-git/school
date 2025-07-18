<?php

namespace App\Controller\Web\Course\Create\v1;

use App\Controller\Web\Course\Create\v1\Output\CreatedCourseDTO;
use App\Controller\Web\Course\Create\v1\Input\CreateCourseDTO;
use App\Domain\Model\CreateCourseModel;
use App\Domain\Service\LectureService;
use App\Domain\Service\CourseService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateCourseModel> */
        private readonly ModelFactory $modelFactory,
        private readonly CourseService $courseService,
        private readonly LectureService $lectureService,
    ) {
    }

    public function create(CreateCourseDTO $createCourseDTO): CreatedCourseDTO
    {
        $createCourseModel =  $this->modelFactory->makeModel(CreateCourseModel::class, $createCourseDTO->titleCourse, $createCourseDTO->isActive, $createCourseDTO->titleLectures);
        $course = $this->courseService->createCourse($createCourseModel);

        if (!empty($createCourseDTO->titleLectures)) {
            foreach ($createCourseDTO->titleLectures as $title) {
                $this->lectureService->postLecture($course, $title, $createCourseDTO->isActive);
            }
        }

        return new CreatedCourseDTO(
            $course->getId(),
            $course->getTitleCourse(),
            $course->getIsActive(),
            $course->getCreatedAt()->format('Y-m-d H:i:s'),
            $course->getUpdatedAt()->format('Y-m-d H:i:s'),
            $course->getLectures()
        );
    }
}
