<?php

namespace App\UI\Web\Controller;

use App\Application\DTO\SendMessageDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{

    #[Route('/message', name: 'message_send', methods: ['POST'])]
    public function send(SendMessageDTO $dto): JsonResponse
    {


        return $this->json([], JsonResponse::HTTP_CREATED);
    }

}
