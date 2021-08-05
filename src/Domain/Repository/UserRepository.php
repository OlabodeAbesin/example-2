<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\Exception\UserAlreadyExistException;
use App\Domain\Exception\UserNotFoundException;

interface UserRepository
{

    /**
     * @throws UserAlreadyExistException
     */
    public function saveNew(User $user):void;

    /**
     * @throws UserNotFoundException
     */
    public function findById(string $userId):User;

}
