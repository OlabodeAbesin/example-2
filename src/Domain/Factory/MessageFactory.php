<?php

namespace App\Domain\Factory;

use App\Application\DTO\SendMessageDTO;
use App\Domain\Entity\Message;
use App\Domain\Repository\UserRepository;

class MessageFactory
{

    public function __construct(
        private UUIDFactory $UUIDFactory,
        private UserRepository $userRepository,
    )
    {
    }

    public function create(SendMessageDTO $dto):Message
    {
        $id = $this->UUIDFactory->generate();
        $content = $dto->message;
        $recipient = $this->userRepository->findById($dto->userId);

        return new Message($id, $content, $recipient);
    }
}
