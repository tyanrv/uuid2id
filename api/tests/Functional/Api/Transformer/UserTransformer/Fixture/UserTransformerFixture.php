<?php

declare(strict_types=1);

namespace Test\Functional\Api\Transformer\UserTransformer\Fixture;

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class UserTransformerFixture extends AbstractFixture
{
    public const UUID_1 = '872553ec-5e23-4952-ae01-edfe998b4e4f';
    public const UUID_2 = '9a8d99a1-1952-4e85-8337-96e55b9d595c';

    public function load(ObjectManager $manager)
    {
        $uuidType = new UUIDType(self::UUID_1);
        $userTransformer = UserTransformer::createFromUUID($uuidType);

        $uuidType2 = new UUIDType(self::UUID_2);
        $userTransformer2 = UserTransformer::createFromUUID($uuidType2);

        $manager->persist($userTransformer);
        $manager->persist($userTransformer2);

        $manager->flush();
    }
}
