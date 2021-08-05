<?php

namespace App\Application\DTO;

class SendMessageDTO implements DataTransferObject
{

    public function __construct(

        public string $userId,
        public string $message

    )
    {
    }

}
