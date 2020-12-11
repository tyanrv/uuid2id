<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type\Transformer;

use App\Model\Transformer\Type\IdType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class IdTypeDb extends IntegerType
{
    public const NAME = 'id_type';

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return int
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value instanceof IdType ? $value->getValue() : (int)$value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return IdType|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IdType
    {
        return !empty($value) ? new IdType((int)$value) : null;
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
