<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Message;
use App\Domain\Exception\MessageAlreadyExistException;

interface MessageRepository
{

    /**
     * @throws MessageAlreadyExistException
     */
    public function saveNew(Message $message):void;

}
