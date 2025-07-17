<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Table(name: 'course')]
#[ORM\Entity]
class Course implements EntityInterface
{
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'courses')]
    private $users;

    public function __construct()
    {
        $this->lectures = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Lecture::class, mappedBy: 'course')]
    private Collection $lectures;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    private string $titleCourse;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: true)]
    private DateTime $updatedAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    private DateTime $deletedAt;

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

    public function getTitleCourse(): string
    {
        return $this->titleCourse;
    }

    public function setTitleCourse(string $titleCourse): void
    {
        $this->titleCourse = $titleCourse;
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

    public function getIsActive(): ?int {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): void {
        $this->isActive = $isActive;
    }

    public function addLecture(Lecture $lecture): void
    {
        if (!$this->lectures->contains($lecture)) {
            $this->lectures->add($lecture);
        }
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $user->addCourse($this); // Обновляем связанную сторону
        }

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getLectures(): ?array {
        return array_map(static fn(Lecture $lecture) => $lecture->toArray(), $this->lectures->toArray());
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titleCourse' => $this->titleCourse,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'isActive' => $this->isActive,
            'lectures' => array_map(static fn(Lecture $lecture) => $lecture->toArray(), $this->lectures->toArray()),
            'users' => array_map(static fn(User $user) => $user->toArray(), $this->users->toArray()),
        ];
    }
}
