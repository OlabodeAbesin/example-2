<?php

namespace App\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{

    #[Route('/message', name: 'message_send', methods: ['POST'])]
    public function send(): JsonResponse
    {
        return $this->json([], JsonResponse::HTTP_CREATED);
    }

}
