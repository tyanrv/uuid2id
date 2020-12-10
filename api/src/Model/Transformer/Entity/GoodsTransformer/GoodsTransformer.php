<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\GoodsTransformer;

use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class GoodsTransformer
 * @package App\Model\Transformer\Entity\GoodsTransformer
 * @ORM\Entity
 */
class GoodsTransformer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="id_type", unique=true)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="goods_transformer_seq", initialValue=1, allocationSize=1)
     */
    private IdType $id;
    /**
     * @ORM\Column(type="uuid_type", unique=true)
     */
    private UUIDType $uuid;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    /**
     * GoodsTransformer constructor.
     * @param UUIDType $uuid
     * @param DateTimeImmutable $createdAt
     */
    private function __construct(UUIDType $uuid, DateTimeImmutable $createdAt)
    {
        $this->uuid = $uuid;
        $this->createdAt = $createdAt;
    }

    /**
     * @return null|IdType
     */
    public function getId(): ?IdType
    {
        return $this->id ?? null;
    }

    /**
     * @return UUIDType
     */
    public function getUuid(): UUIDType
    {
        return $this->uuid;
    }

    public static function createFromUUID(UUIDType $uuid, DateTimeImmutable $createdAt): self
    {
        return new self($uuid, $createdAt);
    }
}
