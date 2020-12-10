<?php

declare(strict_types=1);


namespace Functional\Api\Transformer\UserTransformer;


use Ramsey\Uuid\Uuid;
use Test\Functional\Api\Transformer\UserTransformer\Fixture\UserTransformerFixture;
use Test\Functional\WebTestCase;

class AddActionTest extends WebTestCase
{
    private string $url = '/user_transformer/add';

    public function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures(
            [
                UserTransformerFixture::class
            ]
        );
    }

    public function testMethod(): void
    {
        $response = $this->app()->handle(self::json('GET', $this->url));

        self::assertEquals(405, $response->getStatusCode());
    }

    public function testSuccess(): void
    {
        $uuid = Uuid::uuid4()->toString();

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));

        self::assertEquals(200, $response->getStatusCode());
    }

    public function testAlreadyExists(): void
    {
        $uuid = UserTransformerFixture::$UUID_1;

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(409, $response->getStatusCode());
        self::assertEquals(
            'User Transformer with this UUID already exists.',
            $data['message']
        );
    }

    public function testUrlNotFound(): void
    {
        $uuid = Uuid::uuid4()->toString();

        $response = $this->app()->handle(self::json('POST', $this->url . '/asd', ['uuid' => $uuid]));

        self::assertEquals(404, $response->getStatusCode());
    }

    public function testInvalidUUID(): void
    {
        $uuid = 'asdasd';

        $response = $this->app()->handle(self::json('POST', $this->url, ['uuid' => $uuid]));
        $data = json_decode($response->getBody()->getContents(), true);
        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This is not a valid UUID.', $data['errors']['uuid']);
    }

    public function testEmpty(): void
    {
        $response = $this->app()->handle(self::json('POST', $this->url, []));
        $data = json_decode($response->getBody()->getContents(), true);
        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This value should not be blank.', $data['errors']['uuid']);
    }
}