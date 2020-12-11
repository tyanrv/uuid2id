<?php

declare(strict_types=1);

namespace App\ReadModel\Transformer\UserTransformer;

use App\Helper\FormatHelper;
use App\Model\Transformer\Command\UserTransformer\UserTransformer\Command;
use App\Model\Transformer\Entity\UserTransformer\UserTransformer;
use App\Model\Transformer\Entity\UserTransformer\UserTransformerRepository;
use App\Model\Transformer\Type\UUIDType;

class UserTransformerFetcher
{
    private UserTransformerRepository $repository;

    /**
     * UserTransformerFetcher constructor.
     * @param UserTransformerRepository $repository
     */
    public function __construct(UserTransformerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUserTransformerByUUID(Command $command): array
    {
        $uuid = new UUIDType($command->uuid);
        return $this->convertUserTransformerToArray($this->repository->getByUUID($uuid));
    }

    private function convertUserTransformerToArray(UserTransformer $userTransformer): array
    {
        return [
            'id' => $userTransformer->getId()->getValue(),
            'uuid' => $userTransformer->getUuid()->getValue(),
            'created_at' => $userTransformer->getCreatedAt()->format(FormatHelper::FRONTEND_DATE_FORMAT),
        ];
    }
}
