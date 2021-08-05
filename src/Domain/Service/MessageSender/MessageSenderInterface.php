<?php

namespace App\Domain\Service\MessageSender;

use App\Domain\Entity\Message;
use App\Domain\Exception\CannotSendMessage;

interface MessageSenderInterface
{

    /**
     * @throws CannotSendMessage
     */
    public function send(Message $message):void;

}
