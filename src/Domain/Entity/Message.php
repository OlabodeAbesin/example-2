<?php

namespace App\Domain\Entity;

use App\Domain\Exception\EmptyMessageException;

class Message
{

    public function __construct(
        private string $id,
        private string $content,
        private User $recipient,
    )
    {
        if(strlen($this->content) === 0){
            throw new EmptyMessageException('Message cannot be empty.');
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getRecipient(): User
    {
        return $this->recipient;
    }

}
