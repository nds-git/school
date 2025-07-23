<?php

namespace App\Controller\Web\Homework\Create\v1;

use App\Controller\Web\Homework\Create\v1\Output\CreatedHomeworkDTO;
use App\Controller\Web\Homework\Create\v1\Input\CreateHomeworkDTO;
use App\Domain\Model\CreateHomeworkModel;
use App\Domain\Service\HomeworkService;
use App\Domain\Service\ModelFactory;

class Manager
{
    public function __construct(
        /** @var ModelFactory<CreateHomeworkModel> */
        private readonly ModelFactory $modelFactory,
        private readonly HomeworkService $homeworkService,
    ) {
    }

    public function create(CreateHomeworkDTO $createHomeworkDTO): CreatedHomeworkDTO
    {
        $createHomeworkModel =  $this->modelFactory->makeModel(
            CreateHomeworkModel::class,
            $createHomeworkDTO->userId,
            $createHomeworkDTO->exUserAnswer,
            $createHomeworkDTO->exTeacherComment,
            $createHomeworkDTO->exerciseId,
            $createHomeworkDTO->exSpeakPoint,
            $createHomeworkDTO->exAudioPoint,
            $createHomeworkDTO->isVerified,
        );

        $homework = $this->homeworkService->createHomework($createHomeworkModel);

        return new CreatedHomeworkDTO(
            $homework->getId(),
            $homework->getExUserAnswer(),
            $homework->getExTeacherComment(),
            $homework->getExerciseId(),
            $homework->getExSpeakPoint(),
            $homework->getExAudioPoint(),
            $homework->getIsVerified(),
        );
    }
}
