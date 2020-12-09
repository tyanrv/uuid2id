<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\UserTransformer;

use App\Model\Transformer\Type\UUIDType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserTransformerRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $em, EntityRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function add(UserTransformer $userTransformer): void
    {
        $this->em->persist($userTransformer);
    }

    public function remove(UserTransformer $userTransformer): void
    {
        $this->em->remove($userTransformer);
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
}
