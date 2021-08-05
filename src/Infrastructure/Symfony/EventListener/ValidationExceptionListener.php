<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\EventListener;

use App\Infrastructure\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\ConstraintViolation;

final class ValidationExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        // You get the exception object from the received event
        $exception = $event->getThrowable();

        if (! $exception instanceof ValidationException) {
            return;
        }

        $errorMessages = [];

        foreach ($exception->getConstraintViolationList() as $violation) {
            assert($violation instanceof ConstraintViolation);

            $keys = explode('.', $violation->getPropertyPath());
            $messageArray = $this->createMessageArray($keys, (string) $violation->getMessage());
            $errorMessages = array_merge_recursive($errorMessages, $messageArray);
        }

        // Customize your response object to display the exception details
        $response = new JsonResponse(
            (object) [
                'errorMessage' => 'Validation error',
                'validationMessages' => $errorMessages,
            ],
        );

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details

        $response->setStatusCode(Response::HTTP_BAD_REQUEST);

        // sends the modified response object to the event
        $event->setResponse($response);
    }

    private function createMessageArray(array $keys, string $message): array
    {
        if (count($keys) > 1) {
            $key = array_shift($keys);
            return [
                $key => $this->createMessageArray($keys, $message),
            ];
        }

        return [
            $keys[0] => [$message],
        ];
    }
}
