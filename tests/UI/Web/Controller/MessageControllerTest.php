<?php

namespace App\Tests\UI\Web\Controller;

use App\UI\Web\Controller\MessageController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @coversDefaultClass \App\UI\Web\Controller\MessageController
 */
class MessageControllerTest extends WebTestCase
{

    /**
     * @covers ::send
     */
    public function testSend()
    {
        $json = <<<json
        {
            "userId": "cb6b2eb0-a1de-410e-b554-e720365ed037",
            "message": "test message"
        }
        json;


        $this->jsonRequest('POST', '/message', $json);
        $this->assertResponseCode(JsonResponse::HTTP_CREATED);

        $response = $this->jsonContentToArray();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response['id']);
        $this->assertSame('test message', $response['content']);
        $this->assertSame("cb6b2eb0-a1de-410e-b554-e720365ed037", $response['recipient']['id']);
    }
}
