<?php

declare(strict_types=1);

namespace App\Model\Transformer\Test\Entity\UserTransformer;

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TypeError;

class UserTransformerTest extends TestCase
{
    public function testCreateFromUUID(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $goodsTransformer = UserTransformer::createFromUUID($uuidType);

        self::assertTrue($goodsTransformer instanceof UserTransformer);
        self::assertTrue($goodsTransformer->getUuid() instanceof UUIDType);
        self::assertTrue($uuidType->getValue() === $goodsTransformer->getUuid()->getValue());
    }

    public function testGetIdTypeIsNull(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $goodsTransformer = UserTransformer::createFromUUID($uuidType);

        self::assertFalse($goodsTransformer->getId() instanceof IdType);
        self::assertNull($goodsTransformer->getId());
    }

    public function testIncorrectCreateFromUUID(): void
    {
        $this->expectException(TypeError::class);
        UserTransformer::createFromUUID(null);
    }
}
