<?php

declare(strict_types=1);

namespace App\Model\Transformer\Command\UserTransformer\Add;

use App\Flusher\Flusher;
use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Entity\UserTransformer\UserTransformerRepository;
use App\Model\Transformer\Type\UUIDType;

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
        $userTransformer = UserTransformer::createFromUUID($uuidType);

        $this->repository->add($userTransformer);
        $this->flusher->flush();
    }
}
