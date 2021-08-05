<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Message;
use App\Domain\Exception\MessageAlreadyExistException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class MessageRepository extends EntityRepository implements \App\Domain\Repository\MessageRepository
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Message::class));
    }

    public function saveNew(Message $message): void
    {
        if($this->find($message->getId())){
            throw new MessageAlreadyExistException();
        }

        $this->_em->persist($message);
        $this->_em->flush();
    }

}
