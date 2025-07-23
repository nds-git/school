<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Table(name: 'lecture')]
#[ORM\Entity]
#[ORM\Index(name: 'lecture__course_id__idx', columns: ['course_id'])]
class Lecture implements EntityInterface
{
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }

    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'Course', inversedBy: 'lectures')]
    #[ORM\JoinColumn(name: 'course_id', referencedColumnName: 'id')]
    private Course $course;

    #[ORM\OneToMany(targetEntity: Exercise::class, mappedBy: 'lecture')]
    private Collection $exercises;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    private string $titleLecture;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private DateTime $updatedAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    private DateTime $deletedAt;

    #[ORM\Column(name: 'course_id', type: 'bigint', nullable: true)]
    private int $courseId;

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

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getTitleLecture(): string
    {
        return $this->titleLecture;
    }

    public function setTitleLecture(string $titleLecture): void
    {
        $this->titleLecture = $titleLecture;
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

    public function getCourseId(): ?int {
        return $this->courseId;
    }

    public function setCourseId(int $courseId): void {
        $this->courseId = $courseId;
    }

    public function getIsActive(): ?int {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): void {
        $this->isActive = $isActive;
    }

    public function addExercise(Exercise $exercise): void
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises->add($exercise);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titleLecture' => $this->titleLecture,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'isActive' => $this->isActive,
            'exercise' => array_map(static fn(Exercise $exercise) => $exercise->toArray(), $this->exercises->toArray()),
        ];
    }
}
