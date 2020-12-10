<?php

declare(strict_types=1);

namespace Test\Functional\Api\Transformer\UserTransformer\Fixture;

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserTransformerFixture extends AbstractFixture
{
    public static string $UUID_1;
    public static string $UUID_2;

    public function load(ObjectManager $manager)
    {
        self::$UUID_1 = Uuid::uuid4()->toString();
        self::$UUID_2 = Uuid::uuid4()->toString();

        $uuidType = new UUIDType(self::$UUID_1);
        $userTransformer = UserTransformer::createFromUUID($uuidType);

        $uuidType2 = new UUIDType(self::$UUID_2);
        $userTransformer2 = UserTransformer::createFromUUID($uuidType2);

        $manager->persist($userTransformer);
        $manager->persist($userTransformer2);

        $manager->flush();
    }
}
