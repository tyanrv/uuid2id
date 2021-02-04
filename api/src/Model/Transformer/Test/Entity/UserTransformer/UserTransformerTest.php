<?php

declare(strict_types=1);

namespace App\Model\Transformer\Test\Entity\UserTransformer;

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TypeError;

class UserTransformerTest extends TestCase
{
    public function testCreateFromUUID(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $userTransformer = UserTransformer::createFromUUID($uuidType, new DateTimeImmutable());

//        self::assertTrue($userTransformer instanceof UserTransformer);
        self::assertTrue($userTransformer->getUuid() instanceof UUIDType);
        self::assertTrue($uuidType->getValue() === $userTransformer->getUuid()->getValue());
    }

    public function testGetIdTypeIsNull(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $userTransformer = UserTransformer::createFromUUID($uuidType, new DateTimeImmutable());

        self::assertFalse($userTransformer->getId() instanceof IdType);
        self::assertNull($userTransformer->getId());
    }

    public function testIncorrectCreateFromUUID(): void
    {
        $this->expectException(TypeError::class);
        UserTransformer::createFromUUID(null, new DateTimeImmutable());
    }
}
