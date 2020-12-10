<?php

declare(strict_types=1);

namespace App\Model\Transformer\Command\GoodsTransformer\Add;

use App\Flusher\Flusher;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformerRepository;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use DomainException;

class Handler
{
    private Flusher $flusher;
    private GoodsTransformerRepository $repository;

    public function __construct(
        Flusher $flusher,
        GoodsTransformerRepository $repository
    ) {
        $this->flusher = $flusher;
        $this->repository = $repository;
    }

    public function handle(Command $command): void
    {
        $uuidType = new UUIDType($command->uuid);

        if ($this->repository->hasByUUID($uuidType)) {
            throw new DomainException('Goods Transformer with this UUID already exists.');
        }

        $goodsTransformer = GoodsTransformer::createFromUUID($uuidType, new DateTimeImmutable());

        $this->repository->add($goodsTransformer);
        $this->flusher->flush();
    }
}
