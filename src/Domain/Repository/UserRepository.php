<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Domain\Exception\UserAlreadyExistException;

interface UserRepository
{

    /**
     * @throws UserAlreadyExistException
     */
    public function saveNew(User $user):void;

}
