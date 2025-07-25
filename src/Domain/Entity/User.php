<?php

namespace App\Domain\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Domain\ValueObject\RoleEnum;
use Doctrine\ORM\Mapping as ORM;
use DateInterval;
use DateTime;

#[ORM\Table(name: '`user`')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'user__login__uniq', columns: ['login'], options: ['where' => '(deleted_at IS NULL)'])]
class User implements EntityInterface, HasMetaTimestampsInterface, SoftDeletableInterface, SoftDeletableInFutureInterface, UserInterface, PasswordAuthenticatedUserInterface
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
        $this->exerciseUserPoint = new ArrayCollection();
        $this->lectureUserPoint = new ArrayCollection();
        $this->courseUserPoint = new ArrayCollection();
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

    #[ORM\Column(type: 'string', nullable: false)]
    private string $password;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $age;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $isActive;

    #[ORM\Column(type: 'json', length: 1024, nullable: false)]
    private array $roles = [];

    #[ORM\OneToMany(targetEntity: ExerciseUserPoint::class, mappedBy: 'user')]
    private Collection $exerciseUserPoint;

    #[ORM\OneToMany(targetEntity: LectureUserPoint::class, mappedBy: 'user')]
    private Collection $lectureUserPoint;

    #[ORM\OneToMany(targetEntity: CourseUserPoint::class, mappedBy: 'user')]
    private Collection $courseUserPoint;

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

    public function isCourseBelongs(Course $course): bool {
        if ($this->courses->contains($course)) {
            return true;
        }

        return false;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getCourses(): ?array {
        return array_map(static fn(Course $course) => $course->toArray(), $this->courses->toArray());
    }

    public function getIsActive(): int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = RoleEnum::ROLE_USER->value;

        return array_unique($roles);
    }

    /**
     * @param string[] $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'age' => $this->age,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'roles' => array_merge($this->roles, [RoleEnum::ROLE_USER->value]),
            'deletedAt' => !is_null($this->deletedAt) ? $this->deletedAt->format('Y-m-d H:i:s') : '',
            'courses' => array_map(static fn(Course $course) => $course->toArray(), $this->courses->toArray()),
        ];
    }
}
