<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'lecture_user_point')]
#[ORM\Entity]
class LectureUserPoint implements EntityInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'exercise_user_point')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ORM\Column(name: 'user_id', type: 'bigint', nullable: false)]
    private int $userId;

    #[ORM\ManyToOne(targetEntity: 'Lecture', inversedBy: 'lecture_user_point')]
    #[ORM\JoinColumn(name: 'lecture_id', referencedColumnName: 'id')]
    private Lecture $lecture;

    #[ORM\Column(name: 'lecture_id', type: 'bigint', nullable: false)]
    private int $lectureId;

    #[ORM\Column(name: 'sum_lecture_point', type: 'integer', nullable: true)]
    private ?int $sumLecturePoint;

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

    public function getSumLecturePoint(): ?int
    {
        return $this->sumLecturePoint;
    }

    public function setSumLecturePoint(?int $sumLecturePoint): void
    {
        $this->sumLecturePoint = $sumLecturePoint;
    }

    public function getIsVerified(): int
    {
        return $this->isVerified;
    }

    public function setIsVerified(int $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    public function getLecture(): Lecture
    {
        return $this->lecture;
    }

    public function setLecture(Lecture $lecture): void
    {
        $this->lecture = $lecture;
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
            'sumLecturePoint' => $this->sumLecturePoint,
            'isVerified' => $this->isVerified,
        ];
    }
}
