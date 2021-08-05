<?php

namespace App\Tests\UI\Web\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class WebTestCase extends SymfonyWebTestCase
{

    protected KernelBrowser $client;


    protected function setUp(): void
    {
        $this->client = static::createClient([
            'environment' => 'test',
        ]);
    }

    protected function jsonRequest(string $method, string $uri, ?string $jsonBody = null): ?Crawler
    {
        $server['CONTENT_TYPE'] = 'application/json';

        return $this->client->request($method, $uri, [], [], $server, $jsonBody);
    }

    public function assertResponseCode(int $expectedResponseCode)
    {
        $this->assertSame($expectedResponseCode, $this->client->getResponse()->getStatusCode());
    }

    protected function jsonContentToArray(): array
    {
        return json_decode($this->client->getResponse()->getContent(), true);
    }

}
