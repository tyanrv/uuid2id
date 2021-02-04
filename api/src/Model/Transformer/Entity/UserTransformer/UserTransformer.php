<?php

declare(strict_types=1);

namespace App\Model\Transformer\Entity\UserTransformer;

use App\Model\Transformer\Type\IdType;
use App\Model\Transformer\Type\UUIDType;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserTransformer
 * @package App\Model\Transformer\Entity\UserTransformer
 * @ORM\Entity
 */
class UserTransformer
{
    /**
     * @psalm-suppress PropertyNotSetInConstructor
     * @ORM\Id
     * @ORM\Column(type="id_type", unique=true)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="user_transformer_seq", initialValue=1, allocationSize=1)
     */
    private ?IdType $id;
    /**
     * @ORM\Column(type="uuid_type", unique=true)
     */
    private UUIDType $uuid;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    /**
     * UserTransformer constructor.
     * @param UUIDType $uuid
     * @param DateTimeImmutable $date
     */
    private function __construct(UUIDType $uuid, DateTimeImmutable $date)
    {
        $this->uuid = $uuid;
        $this->createdAt = $date;
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

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public static function createFromUUID(UUIDType $uuid, DateTimeImmutable $createdAt): self
    {
        return new self($uuid, $createdAt);
    }
}
