<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\Transformer;

use App\Model\Transformer\Type\UUIDType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UUIDTypeDb extends GuidType
{
    public const NAME = 'uuid_type';

    /**
     * @param UUIDType|string|int $value
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        /** @var UUIDType $value */
        return $value instanceof UUIDType ? $value->getValue() : (string)$value;
    }

    /**
     * @param string|int|null $value
     * @param AbstractPlatform $platform
     * @return UUIDType|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?UUIDType
    {
        return !empty($value) ? new UUIDType((string)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
