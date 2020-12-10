<?php

declare(strict_types=1);

namespace Test\Functional\Api\Transformer\GoodsTransformer\Fixture;

use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class GoodsTransformerFixture extends AbstractFixture
{
    public const UUID_1 = '872553ec-5e23-4952-ae01-edfe998b4e4f';
    public const UUID_2 = '9a8d99a1-1952-4e85-8337-96e55b9d595c';

    public function load(ObjectManager $manager)
    {
        $uuidType = new UUIDType(self::UUID_1);
        $goodsTransformer = GoodsTransformer::createFromUUID($uuidType);

        $uuidType2 = new UUIDType(self::UUID_2);
        $goodsTransformer2 = GoodsTransformer::createFromUUID($uuidType2);

        $manager->persist($goodsTransformer);
        $manager->persist($goodsTransformer2);
        $manager->flush();
    }
}
