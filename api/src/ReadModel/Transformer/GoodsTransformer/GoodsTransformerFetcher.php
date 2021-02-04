<?php

declare(strict_types=1);

namespace App\ReadModel\Transformer\GoodsTransformer;

use App\Helper\FormatHelper;
use App\Model\Transformer\Command\GoodsTransformer\GoodsTransformer\Command;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformer;
use App\Model\Transformer\Entity\GoodsTransformer\GoodsTransformerRepository;
use App\Model\Transformer\Type\UUIDType;

class GoodsTransformerFetcher
{
    private GoodsTransformerRepository $repository;

    /**
     * GoodsTransformerFetcher constructor.
     * @param GoodsTransformerRepository $repository
     */
    public function __construct(GoodsTransformerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getGoodsTransformerByUUID(Command $command): array
    {
        $uuid = new UUIDType($command->uuid);
        return $this->convertGoodsTransformerToArray($this->repository->getByUUID($uuid));
    }

    private function convertGoodsTransformerToArray(GoodsTransformer $goodsTransformer): array
    {
        $idType = $goodsTransformer->getId();
        return [
            'id' => $idType ? $idType->getValue(): null,
            'uuid' => $goodsTransformer->getUuid()->getValue(),
            'created_at' => $goodsTransformer->getCreatedAt()->format(FormatHelper::FRONTEND_DATE_FORMAT),
        ];
    }
}
