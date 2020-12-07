<?php


namespace Test\Functional;


class HomeTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $response = $this->app()->handle(self::json('GET', '/'));

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals('{}', (string)$response->getBody());
    }

    public function testMethod(): void
    {
        $response = $this->app()->handle($this->json('POST', '/'));

        self::assertEquals(405, $response->getStatusCode());
    }
}