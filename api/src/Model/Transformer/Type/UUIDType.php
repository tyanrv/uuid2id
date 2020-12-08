<?php

declare(strict_types=1);

namespace App\Model\Transformer\Type;

use Webmozart\Assert\Assert;

class UUIDType
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value, 'The value cannot be empty.');
        Assert::string($value, 'The value must be string type.');
        Assert::uuid($value, 'The value must be UUID type.');

        $this->value = $value;
    }

    public function isEqualTo(self $another): bool
    {
        if ($this->getValue() === $another->getValue()) {
            return true;
        }

        return false;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
