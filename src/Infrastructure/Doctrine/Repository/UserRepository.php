<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\User;
use App\Domain\Exception\UserAlreadyExistException;
use App\Domain\Exception\UserNotFoundException;
use App\Domain\Repository\UserRepository as DomainUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements DomainUserRepository
{

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(User::class));
    }

    public function saveNew(User $user): void
    {
        if($this->find($user->getId()) instanceof User){
            throw new UserAlreadyExistException();
        }

        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function findById(string $userId): User
    {
        $user = $this->find($userId);

        if(!$user instanceof User){
            throw new UserNotFoundException();
        }

        return $user;
    }


}
