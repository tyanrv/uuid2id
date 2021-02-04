<?php

declare(strict_types=1);

namespace App\Model\Transformer\Test\Entity\GoodsTransformer;

use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use TypeError;

class GoodsTransformerTest extends TestCase
{
    public function testCreateFromUUID(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $goodsTransformer = GoodsTransformer::createFromUUID($uuidType, new DateTimeImmutable());

//        self::assertTrue($goodsTransformer instanceof GoodsTransformer);
        self::assertTrue($goodsTransformer->getUuid() instanceof UUIDType);
        self::assertTrue($uuidType->getValue() === $goodsTransformer->getUuid()->getValue());
    }

    public function testGetIdTypeIsNull(): void
    {
        $uuid = Uuid::uuid4();
        $uuidType = new UUIDType($value = $uuid->toString());
        $goodsTransformer = GoodsTransformer::createFromUUID($uuidType, new DateTimeImmutable());

        self::assertFalse($goodsTransformer->getId() instanceof IdType);
        self::assertNull($goodsTransformer->getId());
    }

    public function testIncorrectCreateFromUUID(): void
    {
        $this->expectException(TypeError::class);
        GoodsTransformer::createFromUUID(null, new DateTimeImmutable());
    }
}
