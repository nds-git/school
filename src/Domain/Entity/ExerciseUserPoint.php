<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'exercise_user_point')]
#[ORM\Entity]
class ExerciseUserPoint implements EntityInterface
{
    #[ORM\Column(name: 'id', type: 'bigint', unique: true)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'exercise_user_point')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private User $user;

    #[ORM\Column(name: 'user_id', type: 'bigint', nullable: true)]
    private int $userId;

    #[ORM\Column(name: 'ex_speak_point', type: 'integer', nullable: true)]
    private ?int $exSpeakPoint;

    #[ORM\Column(name: 'ex_audio_point', type: 'integer', nullable: true)]
    private ?int $exAudioPoint;

    #[ORM\Column(name: 'exercise_id', type: 'integer', nullable: false)]
    private int $exerciseId;

    #[ORM\Column(name: 'ex_user_answer', type: 'text', nullable: true)]
    private string $exUserAnswer;

    #[ORM\Column(name: 'ex_teacher_comment', type: 'text', nullable: true)]
    private ?string $exTeacherComment;

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

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getExSpeakPoint(): ?int
    {
        return $this->exSpeakPoint;
    }

    public function setExSpeakPoint(?int $exSpeakPoint): void
    {
        $this->exSpeakPoint = $exSpeakPoint;
    }

    public function getExAudioPoint(): ?int
    {
        return $this->exAudioPoint;
    }

    public function setExAudioPoint(?int $exAudioPoint): void
    {
        $this->exAudioPoint = $exAudioPoint;
    }

    public function getExUserAnswer(): string
    {
        return $this->exUserAnswer;
    }

    public function setExUserAnswer(string $exUserAnswer): void
    {
        $this->exUserAnswer = $exUserAnswer;
    }

    public function getExTeacherComment(): ?string
    {
        return $this->exTeacherComment;
    }

    public function setExTeacherComment(?string $exTeacherComment): void
    {
        $this->exTeacherComment = $exTeacherComment;
    }

    public function getIsVerified(): int
    {
        return $this->isVerified;
    }

    public function setIsVerified(int $isVerified): void
    {
        $this->isVerified = $isVerified;
    }

    public function getExerciseId(): int
    {
        return $this->exerciseId;
    }

    public function setExerciseId(int $exerciseId): void
    {
        $this->exerciseId = $exerciseId;
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
            'user' => $this->user,
            'exSpeakPoint' => $this->exSpeakPoint,
            'exAudioPoint' => $this->exAudioPoint,
            'exUserAnswer' => $this->exUserAnswer,
            'exTeacherComment' => $this->exTeacherComment,
            'isVerified' => $this->isVerified,
        ];
    }
}
