<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Table(name: 'exercise')]
#[ORM\Entity]
#[ORM\Index(name: 'exercise__lecture_id__idx', columns: ['lecture_id'])]
class Exercise implements EntityInterface
{
    public function __construct()
    {
        $this->exerciseUserPoint = new ArrayCollection();
    }

    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Lecture', inversedBy: 'exercises')]
    #[ORM\JoinColumn(name: 'lecture_id', referencedColumnName: 'id')]
    private Lecture $lecture;

    #[ORM\OneToMany(targetEntity: ExerciseUserPoint::class, mappedBy: 'exercise')]
    private Collection $exerciseUserPoint;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    private string $titleExercise;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private DateTime $updatedAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    private DateTime $deletedAt;

    #[ORM\Column(name: 'lecture_id', type: 'bigint', nullable: true)]
    private int $lectureId;

    #[ORM\Column(name: 'max_speak_point', type: 'integer', nullable: true)]
    private int $maxSpeakPoint;

    #[ORM\Column(name: 'max_audio_point', type: 'integer', nullable: true)]
    private int $maxAudioPoint;

    #[ORM\Column(name: 'is_active', type: 'smallint', nullable: true)]
    private int $isActive;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLecture(): Lecture
    {
        return $this->lecture;
    }

    public function setLecture(Lecture $lecture): void
    {
        $this->lecture = $lecture;
    }

    public function getTitleExercise(): string
    {
        return $this->titleExercise;
    }

    public function setTitleExercise(string $titleExercise): void
    {
        $this->titleExercise = $titleExercise;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(): void {
        $this->createdAt = new DateTime();
    }

    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new DateTime();
    }

    public function getDeletedAt(): ?DateTime {
        return $this->deletedAt;
    }

    public function setDeletedAt(): void {
        $this->deletedAt = new DateTime();
    }

    public function getLectureId(): ?int {
        return $this->lectureId;
    }

    public function setLectureId(int $lectureId): void {
        $this->lectureId = $lectureId;
    }


    public function getMaxSpeakPoint(): int
    {
        return $this->maxSpeakPoint;
    }

    public function setMaxSpeakPoint(int $maxSpeakPoint): void
    {
        $this->maxSpeakPoint = $maxSpeakPoint;
    }

    public function getMaxAudioPoint(): int
    {
        return $this->maxAudioPoint;
    }

    public function setMaxAudioPoint(int $maxAudioPoint): void
    {
        $this->maxAudioPoint = $maxAudioPoint;
    }

    public function getIsActive(): ?int {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): void {
        $this->isActive = $isActive;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titleExercise' => $this->titleExercise,
            'maxSpeakPoint' => $this->maxSpeakPoint ?? 0,
            'maxAudioPoint' => $this->maxAudioPoint ?? 0,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'isActive' => $this->isActive,
        ];
    }
}
