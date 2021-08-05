<?php

namespace App\Application\Service;

use App\Domain\Entity\Message;
use App\Domain\Service\MessageSender\MessageSenderInterface;
use Twilio\Rest\Client;

class TwilioMessageSender implements MessageSenderInterface
{

    public function __construct(
        private Client $client,
        private string $fromNumber,
    )
    {
    }

    public function send(Message $message): void
    {
        $this->client->messages->create(
            $message->getRecipient()->getPhoneNumber(),
            [
                'from' => $this->fromNumber,
                'body' => $message->getContent()
            ]
        );
    }

}
