<?php

namespace App\Domain\Service\MessageSender;

use App\Domain\Entity\Message;
use App\Domain\Exception\CannotSendMessage;

class MessageSenderService
{

    /**
     * @var array<int, MessageSenderInterface>
     */
    private array $senders;

    public function __construct(iterable $senders)
    {
        $this->senders = [];

        foreach ( $senders as $sender ){
            $this->registerSender($sender);
        }
    }

    private function registerSender(MessageSenderInterface $sender): void
    {
        $this->senders[] = $sender;
    }

    public function send(Message $message): void
    {
        foreach ($this->senders as $sender) {

            try {
                $sender->send($message);
                return;
            } catch (CannotSendMessage $cannotSendMessage) {
                //TODO add some logging
                continue;
            }

        }
        throw new CannotSendMessage('Cannot send message.');
    }

}
