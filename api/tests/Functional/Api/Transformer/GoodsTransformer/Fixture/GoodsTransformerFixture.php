<?php

declare(strict_types=1);

namespace Test\Functional\Api\Transformer\GoodsTransformer\Fixture;

use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class GoodsTransformerFixture extends AbstractFixture
{
    public static string $UUID_1 = '';
    public static string $UUID_2 = '';

    public function load(ObjectManager $manager): void
    {
        self::$UUID_1 = Uuid::uuid4()->toString();
        self::$UUID_2 = Uuid::uuid4()->toString();

        $uuidType = new UUIDType(self::$UUID_1);
        $goodsTransformer = GoodsTransformer::createFromUUID($uuidType, new DateTimeImmutable());

        $uuidType2 = new UUIDType(self::$UUID_2);
        $goodsTransformer2 = GoodsTransformer::createFromUUID($uuidType2, new DateTimeImmutable());

        $manager->persist($goodsTransformer);
        $manager->persist($goodsTransformer2);
        $manager->flush();
    }
}
