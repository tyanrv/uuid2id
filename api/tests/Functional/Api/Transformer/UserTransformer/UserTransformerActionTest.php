<?php

declare(strict_types=1);


namespace Functional\Api\Transformer\UserTransformer;


use App\Helper\FormatHelper;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Test\Functional\Api\Transformer\UserTransformer\Fixture\UserTransformerFixture;
use Test\Functional\WebTestCase;

class UserTransformerActionTest extends WebTestCase
{
    private string $url = '/user_transformer';

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
        $response = $this->app()->handle(
            self::json(
                'POST',
                $this->url . '?uuid=' . UserTransformerFixture::$UUID_1
            )
        );

        self::assertEquals(405, $response->getStatusCode());
    }

    public function testSuccess(): void
    {
        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '?uuid=' . UserTransformerFixture::$UUID_1
            )
        );

        $data = json_decode($response->getBody()->getContents(), true);
        $uuidResponse = $data['uuid'];
        $idResponse = $data['id'];
        $date = DateTimeImmutable::createFromFormat(FormatHelper::FRONTEND_DATE_FORMAT, $data['created_at']);

        self::assertEquals(200, $response->getStatusCode());
        self::assertTrue(UserTransformerFixture::$UUID_1 === $uuidResponse);
        self::assertTrue(is_int($idResponse));
        self::assertTrue($date instanceof DateTimeImmutable);
    }

    public function testNotExists(): void
    {
        $uuidRandom = Uuid::uuid4()->toString();

        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '?uuid=' . $uuidRandom
            )
        );
        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(409, $response->getStatusCode());
        self::assertEquals(
            'The User Transformer not found.',
            $data['message']
        );
    }

    public function testUrlNotFound(): void
    {
        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '/fg?uuid123213=' . UserTransformerFixture::$UUID_1
            )
        );

        self::assertEquals(404, $response->getStatusCode());
    }

    public function testInvalidUUID(): void
    {
        $uuid = 'asdasd';

        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url . '?uuid=' . $uuid
            )
        );

        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This is not a valid UUID.', $data['errors']['uuid']);
    }

    public function testEmpty(): void
    {
        $response = $this->app()->handle(
            self::json(
                'GET',
                $this->url
            )
        );

        $data = json_decode($response->getBody()->getContents(), true);

        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('This value should not be blank.', $data['errors']['uuid']);
    }
}