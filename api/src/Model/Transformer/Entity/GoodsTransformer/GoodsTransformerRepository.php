<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\GoodsTransformer;

use Doctrine\ORM\EntityManagerInterface;

class GoodsTransformerRepository
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function add(GoodsTransformer $goodsTransformer): void
    {
        $this->em->persist($goodsTransformer);
    }

    public function remove(GoodsTransformer $goodsTransformer): void
    {
        $this->em->remove($goodsTransformer);
    }
}
