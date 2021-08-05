<?php

namespace App\UI\Web\Controller;

use App\Application\DTO\SendMessageDTO;
use App\Domain\Factory\MessageFactory;
use App\Domain\Repository\MessageRepository;
use App\Domain\Service\MessageSender\MessageSenderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{

    public function __construct(
        private MessageSenderService $messageSender,
        private MessageFactory $messageFactory,
        private MessageRepository $repository,
    )
    {
    }

    #[Route('/message', name: 'message_send', methods: ['POST'])]
    public function send(SendMessageDTO $dto): JsonResponse
    {

        $message = $this->messageFactory->create($dto);
        $this->messageSender->send($message);
        $this->repository->saveNew($message);

        return $this->json( $message , JsonResponse::HTTP_CREATED);
    }

}
