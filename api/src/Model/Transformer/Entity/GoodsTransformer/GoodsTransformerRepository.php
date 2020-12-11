<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\GoodsTransformer;

use App\Model\Transformer\Type\UUIDType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class GoodsTransformerRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        EntityRepository $repository
    ) {
        $this->em = $entityManager;
        $this->repository = $repository;
    }

    public function add(GoodsTransformer $goodsTransformer): void
    {
        $this->em->persist($goodsTransformer);
    }

    public function remove(GoodsTransformer $goodsTransformer): void
    {
        $this->em->remove($goodsTransformer);
    }

    public function hasByUUID(UUIDType $uuid): bool
    {
        return $this->repository->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.uuid = :uuid')
                ->setParameter(':uuid', $uuid)
                ->getQuery()
                ->getSingleScalarResult() > 0;
    }

    public function getByUUID(UUIDType $uuid): GoodsTransformer
    {
        if (!$goodsTransformer = $this->repository->findOneBy(['uuid' => $uuid->getValue()])) {
            throw new DomainException('The Goods Transformer not found.');
        }

        /** @var GoodsTransformer $goodsTransformer */
        return $goodsTransformer;
    }
}
