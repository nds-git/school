<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'course_user_point')]
#[ORM\Entity]
class CourseUserPoint implements EntityInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'course_user_point')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ORM\Column(name: 'user_id', type: 'bigint', nullable: false)]
    private int $userId;

    #[ORM\ManyToOne(targetEntity: 'Course', inversedBy: 'course_user_point')]
    #[ORM\JoinColumn(name: 'course_id', referencedColumnName: 'id')]
    private Course $course;

    #[ORM\Column(name: 'course_id', type: 'bigint', nullable: false)]
    private int $courseId;

    #[ORM\Column(name: 'sum_course_point', type: 'integer', nullable: true)]
    private ?int $sumCoursePoint;

    #[ORM\Column(name: 'is_verified', type: 'smallint', nullable: true)]
    private int $isVerified;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getSumCoursePoint(): ?int
    {
        return $this->sumCoursePoint;
    }

    public function setSumCoursePoint(?int $sumCoursePoint): void
    {
        $this->sumCoursePoint = $sumCoursePoint;
    }

    public function getIsVerified(): int
    {
        return $this->isVerified;
    }

    public function setIsVerified(int $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sumCoursePoint' => $this->sumCoursePoint,
            'isVerified' => $this->isVerified,
        ];
    }
}
