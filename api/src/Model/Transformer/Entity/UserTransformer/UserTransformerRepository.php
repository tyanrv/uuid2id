<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\UserTransformer;

use Doctrine\ORM\EntityManagerInterface;

class UserTransformerRepository
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(UserTransformer $userTransformer): void
    {
        $this->em->persist($userTransformer);
    }

    public function remove(UserTransformer $userTransformer): void
    {
        $this->em->remove($userTransformer);
    }
}
