<?php

declare(strict_types=1);

namespace App\Model\Transformer\Fixture;

use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Type\UUIDType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserTransformerFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $uuid = Uuid::uuid4();
            $uuidType = new UUIDType($uuid->toString());
            $userTransformer = UserTransformer::createFromUUID($uuidType);

            $manager->persist($userTransformer);
        }

        $manager->flush();
    }
}
