<?php

namespace App\Application\RabbitMq;

use Symfony\Component\Serializer\Exception\UnsupportedFormatException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Service\Attribute\Required;
use Doctrine\ORM\EntityManagerInterface;
use PhpAmqpLib\Message\AMQPMessage;

abstract class AbstractConsumer implements ConsumerInterface
{
    private readonly EntityManagerInterface $entityManager;
    private readonly ValidatorInterface $validator;
    private readonly SerializerInterface $serializer;

    abstract protected function getMessageClass(): string;

    abstract protected function handle($message): int;

    #[Required]
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    #[Required]
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    #[Required]
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
    }

    public function execute(AMQPMessage $msg): int
    {
        try {
            $message = $this->serializer->deserialize($msg->getBody(), $this->getMessageClass(), 'json');
            $errors = $this->validator->validate($message);
            if ($errors->count() > 0) {
                return $this->reject((string)$errors);
            }

            return $this->handle($message);
        } catch (UnsupportedFormatException $e) {
            return $this->reject($e->getMessage());
        } finally {
            $this->entityManager->clear();
            $this->entityManager->getConnection()->close();
        }
    }

    protected function reject(string $error): int
    {
        echo "Incorrect message: $error";

        return self::MSG_REJECT;
    }
}
