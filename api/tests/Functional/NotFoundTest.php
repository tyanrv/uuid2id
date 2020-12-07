<?php


namespace Test\Functional;

/**
 * Class NotFoundTest
 * @package Test\Functional
 * @coversNothing
 */
class NotFoundTest extends WebTestCase
{
    public function testNotFound(): void
    {
        $response = $this->app()->handle(self::json('GET', '/not-found'));

        self::assertEquals(404, $response->getStatusCode());
    }
}