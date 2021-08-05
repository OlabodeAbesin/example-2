<?php

namespace App\Domain\Entity;

use App\Domain\Exception\EmptyMessageException;

class Message
{

    public function __construct(
        private string $id,
        private string $content
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

}
