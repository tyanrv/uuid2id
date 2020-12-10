<?php

declare(strict_types=1);

namespace App\Model\Transformer\Command\UserTransformer\Add;

use App\Flusher\Flusher;
use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Entity\UserTransformer\UserTransformerRepository;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use DomainException;

class Handler
{
    private Flusher $flusher;
    private UserTransformerRepository $repository;

    public function __construct(
        Flusher $flusher,
        UserTransformerRepository $repository
    ) {
        $this->flusher = $flusher;
        $this->repository = $repository;
    }

    public function handle(Command $command): void
    {
        $uuidType = new UUIDType($command->uuid);

        if ($this->repository->hasByUUID($uuidType)) {
            throw new DomainException('User Transformer with this UUID already exists.');
        }

        $userTransformer = UserTransformer::createFromUUID($uuidType, new DateTimeImmutable());

        $this->repository->add($userTransformer);
        $this->flusher->flush();
    }
}
