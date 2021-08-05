<?php

namespace App\Domain\Service\MessageSender;

use App\Domain\Entity\Message;
use Psr\Log\LoggerInterface;

class LoggerSender implements MessageSenderInterface
{

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function send(Message $message): void
    {
        $this->logger->debug('Message send: ' . $message->getContent(), ['message' => $message]);
    }

}
