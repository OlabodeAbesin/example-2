<?php

namespace App\Tests\Domain\Service;

use App\Domain\Entity\Message;
use App\Domain\Exception\CannotSendMessage;
use App\Domain\Service\MessageSender\MessageSenderInterface;
use App\Domain\Service\MessageSender\MessageSenderService;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Domain\Service\MessageSender\MessageSenderService
 */
class MessageSenderServiceTest extends TestCase
{

    /**
     * @covers ::send
     * @covers ::registerSender
     * @covers ::__constructor
     */
    public function testSend()
    {
        $message = $this->createMock(Message::class);

        $sender = $this->createSenderMock();
        $sender->expects($this->once())
            ->method('send')
            ->with($message);

        $service = new MessageSenderService([$sender]);

        $service->send($message);
    }

    /**
     * @covers ::send
     */
    public function testSendUsesFallback()
    {
        $message = $this->createMock(Message::class);

        $senderThatFails = $this->createSenderMock();
        $senderThatFails->expects($this->once())
            ->method('send')
            ->with($message)
            ->willThrowException(new CannotSendMessage());

        $senderFallback = $this->createSenderMock();
        $senderFallback->expects($this->once())
            ->method('send')
            ->with($message);

        $service = new MessageSenderService([$senderThatFails, $senderFallback]);

        $service->send($message);
    }

    /**
     * @covers ::send
     */
    public function testSendThrowsExceptionIfAllSenderCannotSendMessage()
    {
        $this->expectException(CannotSendMessage::class);

        $message = $this->createMock(Message::class);

        $senderThatFails = $this->createSenderMock();
        $senderThatFails->expects($this->once())
            ->method('send')
            ->with($message)
            ->willThrowException(new CannotSendMessage());

        $senderFallbackThatAlsoFails = $this->createSenderMock();
        $senderFallbackThatAlsoFails->expects($this->once())
            ->method('send')
            ->with($message)
            ->willThrowException(new CannotSendMessage());

        $service = new MessageSenderService([$senderThatFails, $senderFallbackThatAlsoFails]);

        $service->send($message);
    }

    /**
     * @return MessageSenderInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected function createSenderMock(): mixed
    {
        return $this->getMockBuilder(MessageSenderInterface::class)
            ->onlyMethods(['send'])
            ->getMockForAbstractClass();
    }
}
