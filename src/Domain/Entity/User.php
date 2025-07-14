<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateInterval;
use DateTime;

#[ORM\Table(name: '`user`')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class User implements EntityInterface, HasMetaTimestampsInterface, SoftDeletableInterface, SoftDeletableInFutureInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'users')]
    #[ORM\JoinTable(name: 'user_course')]
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
    }

    #[ORM\Column(type: 'string', length: 32, nullable: false)]
    private string $login;

    #[ORM\Column(type: 'string', length: 150, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime', nullable: false)]
    private DateTime $updatedAt;

    #[ORM\Column(name: 'deleted_at', type: 'datetime', nullable: true)]
    private ?DateTime $deletedAt = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    #[ORM\PrePersist]
    public function setCreatedAt(): void {
        $this->createdAt = new DateTime();
    }

    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(): void {
        $this->updatedAt = new DateTime();
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(): void
    {
        $this->deletedAt = new DateTime();
    }

    public function setDeletedAtInFuture(DateInterval $dateInterval): void
    {
        if ($this->deletedAt === null) {
            $this->deletedAt = new DateTime();
        }
        $this->deletedAt = $this->deletedAt->add($dateInterval);
    }

    public function addCourse(Course $course): void
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'deletedAt' => !is_null($this->deletedAt) ? $this->deletedAt->format('Y-m-d H:i:s') : '',
            'courses' => array_map(static fn(Course $course) => $course->toArray(), $this->courses->toArray()),
        ];
    }
}